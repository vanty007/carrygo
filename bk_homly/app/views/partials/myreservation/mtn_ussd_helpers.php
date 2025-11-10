<?php

#	this script contains all the functions required to run the NSIP USSD service

#	this script processes the XML notifcation message
function process_mtn_ussd_notification($xml_notification = "")
{
    $error = true;
    $data["status"] = true;
    $parameters = [];

    try {
        $clean_xml = str_ireplace(
            ["soapenv:", "soap:", "ns1:", "ns2:"],
            ["", "", "", ""],
            $xml_notification
        );

        $xml = simplexml_load_string(trim($clean_xml));
        $body = $xml->Body;
        $header = $xml->Header;

        $parameters["spRevId"] = $header->NotifySOAPHeader->spRevId;
        $parameters["spRevpassword"] = $header->NotifySOAPHeader->spRevpassword;
        $parameters["spId"] = $header->NotifySOAPHeader->spId;
        $parameters["serviceId"] = $header->NotifySOAPHeader->serviceId;
        $parameters["timeStamp"] = $header->NotifySOAPHeader->timeStamp;
        $parameters["linkid"] = $header->NotifySOAPHeader->linkid;
        $parameters["traceUniqueID"] = $header->NotifySOAPHeader->traceUniqueID;

        $parameters["msgType"] = (int) $body->notifyUssdReception->msgType;
        $parameters["senderCB"] = $body->notifyUssdReception->senderCB;
        $parameters["receiveCB"] = $body->notifyUssdReception->receiveCB;
        $parameters["ussdOpType"] = $body->notifyUssdReception->ussdOpType;
        $parameters["msIsdn"] = $body->notifyUssdReception->msIsdn;
        $parameters["serviceCode"] = $body->notifyUssdReception->serviceCode;
        $parameters["codeScheme"] = $body->notifyUssdReception->codeScheme;
        $parameters["ussdStringReal"] = $body->notifyUssdReception->ussdString;
        $parameters["ussdString"] =
            (int) $body->notifyUssdReception->ussdString;
        if (
            isset($body->notifyUssdReception->extensionInfo->key) &&
            isset($body->notifyUssdReception->extensionInfo->value)
        ) {
            $parameters["key"] = $body->notifyUssdReception->extensionInfo->key;
            $parameters["value"] =
                $body->notifyUssdReception->extensionInfo->value;
        } else {
            $key = "";
            $value = "";
        }

        $abort = $body->notifyUssdAbort->abortReason;
        if ($abort) {
            $error_message = "Session was aborted";
            $data["error_message"] = $error_message;
            $data["status"] = false;
        } else {
            $error = false;
        }
    } catch (\Exception $e) {
        $data["status"] = false;
        $error_message = "Network Error, Please try again later";
        //log_action("Exception: $e", $logFile2);
    }
    if ($error) {
        $data["error_message"] = $error_message;
        $data["status"] = false;
    }
    $data["parameters"] = $parameters;
    return $data;
}

function log_action($msg, $logFile)
{
    $fp = @fopen($logFile, "a+");
    @fputs($fp, "[" . date("Y-m-d H:i:s") . "] - " . $msg . "\n");
    @fclose($fp);
    return true;
}

function sendXMLRequest($url, $xml = "")
{
    $error = false;

    $headers = [
        "POST  HTTP/1.1",
        "Content-type: text/xml,application/soap+xml; charset=\"utf-8\"",
        "SOAPAction: \"\"",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "Connection: keep-alive",
        "Keep-Alive: timeout=10, max=100",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Content-length: " . strlen($xml),
    ];
    $soap_do = curl_init();
    curl_setopt($soap_do, CURLOPT_URL, $url);
    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($soap_do, CURLOPT_POST, true);
    curl_setopt($soap_do, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($soap_do, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($soap_do, CURLOPT_TIMEOUT, 50); //timeout in seconds
    $sendUSSDResponse = curl_exec($soap_do);
    if ($sendUSSDResponse === false) {
        $error = true;
        $response = curl_error($soap_do);
    } else {
        $response = $sendUSSDResponse;
    }
    curl_close($soap_do);
    return;
}

function get_ussd_session($senderCB, $msIsdn)
{
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            //log_action("Failed DB Connection", 'datasync.log');
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception get_ussd_session: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the session
    $sql = "SELECT id, level, service, responses, branch FROM nsip_ussd_sessions WHERE session_id='$senderCB' AND mobile_number= '$msIsdn' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    $session = mysqli_fetch_assoc($result);
    mysqli_close($con);

    return $session;
}

function get_gift_message($senderCB, $msIsdn)
{
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            //log_action("Failed DB Connection", 'datasync.log');
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception get_ussd_session: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the session
    $sql = "SELECT id, gift_message FROM nsip_ussd_sessions WHERE session_id='$senderCB' AND mobile_number= '$msIsdn' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    $session = mysqli_fetch_assoc($result);
    mysqli_close($con);

    return $session;
}

function register_bid($selected_bid_item, $id_session)
{
    //$new_bid = new \App\Models\CreamBid;
    //$new_bid->item_id = $selected_bid_item;
    //$new_bid->session_id = $session->id;
    //$new_bid->save();

    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception register_bid: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the session
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT into cream_bids (session_id, item_id, created_at, updated_at) VALUES ('$id_session', '$selected_bid_item', '$now', '$now')";
    $result = mysqli_query($con, $sql);
    //$session = mysqli_fetch_assoc($result);
    $rows = mysqli_affected_rows($con);
    mysqli_close($con);

    return $rows;
}

function fetch_user_bid($id_session)
{
    //\App\Models\CreamBid::where('session_id', '=', $session->id)->first();
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action(
            "Ready for DB Connection",
            "fetch_user_bid_db_conn_error.log"
        );
        if (mysqli_connect_errno()) {
            log_action(
                "Failed DB Connection",
                "fetch_user_bid_db_conn_error.log"
            );
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception fetch_user_bid: $e",
            "mtn_fetch_user_bid_db_exceptions.log"
        );
    }

    #	get the session
    $sql = "SELECT * FROM cream_bids WHERE session_id = '$id_session' LIMIT 1";
    $result = mysqli_query($con, $sql);
    $bid = mysqli_fetch_assoc($result);
    mysqli_close($con);
    log_action($bid, "fetch_user_bid.log");
    return $bid;
}

function get_today_bid_items($count)
{
    //$items = \App\Models\BidItem::where('status', '=', 'OPEN')
    //	->where('open', '<=', $today)
    //	->where('close', '>', $today)
    //	->orderBy('close', 'ASC')
    //	->take($count)
    //	->get();
    $count = 3;
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action(
                "DB Connection Exception get_today_bid_items: " .
                    mysqli_connect_error(),
                "mtn_bid_db_exceptions.log"
            );
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception get_today_bid_items: $e",
            "mtn_bid_db_exceptions.log"
        );
    }

    #	get the session
    $now = date("Y-m-d H:i:s");
    $sql = "SELECT * FROM bid WHERE ( open <= '$now') AND ( close > '$now' ) AND ( status = 'OPEN' ) ORDER BY id desc LIMIT $count";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $bid_items[] = $row;
    }
    mysqli_close($con);
    log_action(
        "bid items: " . json_encode($bid_items, true),
        "mtn_bid_db_exceptions.log"
    );
    return $bid_items;
}

function update_bid_amount($id_bid, $amount)
{
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action("Ready for DB Connection", "update_bid_amount.log");
        if (mysqli_connect_errno()) {
            log_action(
                "Failed DB Connection: " . mysqli_connect_error(),
                "update_bid_amount_db_error.log"
            );
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception update_bid_amount: $e",
            "update_bid_amount_db_exception.log"
        );
    }

    #	get the session
    $now = date("Y-m-d H:i:s");
    $sql = "UPDATE cream_bids SET amount = '$amount' WHERE id = '$id_bid'";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_affected_rows($con);
    mysqli_close($con);
    return $rows;
}

function get_bid_item($bid_item)
{
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception get_bid-items: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the session
    $sql = "SELECT * FROM bid WHERE id = '$bid_item' LIMIT 1";
    $result = mysqli_query($con, $sql);
    $bid_item = mysqli_fetch_assoc($result);
    mysqli_close($con);
    return $bid_item;
}

function update_wallet_balance($new_balance, $id_wallet)
{
    //\App\Models\CreamBid::where('session_id', '=', $session->id)->first();
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception update_wallet_balance: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the session
    $now = date("Y-m-d H:i:s");
    $sql = "UPDATE wallet SET balance = '$new_balance' WHERE id = '$id_wallet'";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_affected_rows($con);
    mysqli_close($con);
    return $rows;
}

function register_user_bid($amount, $item, $phone, $status, $channel = "USSD")
{
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception register_user_bid: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the session
    $now = date("Y-m-d H:i:s.u");
    $sql = "INSERT into bid_entry (amount,bid,phone,status,channel,created_at) VALUES ('$amount','$item', '$phone', '$status', '$channel',  '$now')";
    log_action("register user bid execution : $sql", "debug_query.log");
    log_action(
        "register user bid execution error: " . mysqli_error($con),
        "debug_query.log"
    );
    $result = mysqli_query($con, $sql);
    $rows = mysqli_affected_rows($con);
    mysqli_close($con);
    return $rows;
}

function get_wallet($mobile_number)
{
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception get_wallet: $e",
            "mtn_db_exceptions.log"
        );
    }

    #	get the wallet
    $sql = "SELECT * FROM wallet WHERE phone_number = '$mobile_number' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    $wallet = mysqli_fetch_assoc($result);
    mysqli_close($con);
    return $wallet;
}

function postvote($msisdn, $content_id, $channel)
{
    $curl = curl_init();
    $data = [
        "content_id" => $content_id,
        "phone" => $msisdn,
        "status" => 1,
        "channel" => $channel,
    ];
    $encodedData = json_encode($data);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://ussd.creamplatform.com/api/vote/postvote",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_TIMEOUT => 0,
        CURLOPT_POSTFIELDS => $encodedData,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => ["Content-Type:application/json"],
    ]);

    $response = curl_exec($curl);
    log_action(
        "webussd-voting ondemand save db request: $encodedData || " .
            "webussd-voting ondemand save db Response: $response",
        "trace_subscription.log"
    );
    curl_close($curl);
}

function create_wallet_transaction($amount, $id_wallet, $description, $type)
{
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception register_user_bid: $e",
            "mtn_db_exceptions.log"
        );
    }
    //$new_transaction = new \App\Models\WalletTransaction;
    ///$new_transaction->amount = $weekly_bid_cost;
    //$new_transaction->wallet_id = $wallet->id;
    //$new_transaction->description = "CREAM Token payment for USSD Submission of N".number_format($bid->amount)." bid for $item->name  (#".$item->number.")";
    //$new_transaction->type = 'debit';
    //$new_transaction->save();

    #	get the session
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT into wallet_transactions (amount,wallet_id,description,type,created_at,updated_at) VALUES ('$amount','$id_wallet', '$description', '$type', '$now', '$now')";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_affected_rows($con);
    mysqli_close($con);
    return $rows;
}

function create_notification($subject, $message, $phone)
{
    try {
        $con = mysqli_connect(
            "155.254.19.119",
            "jACKSOn8",
            "jAKSIN_cR3Am*Db",
            "cream_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "datasync.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "DB Connection Exception create_notification: $e",
            "mtn_db_exceptions.log"
        );
    }
    //$notification = new \App\Models\Notification;
    //$notification->subject = "Product Bid";
    //$notification->message = "You have successfully submitted your bid (NGN $bid->amount) for $item->name (#".$item->number."). Cost NGN $weekly_bid_cost from wallet via USSD.";
    //$notification->read = false;
    //$notification->phone = preg_replace('/^(234)/', "", trim($msIsdn));
    //$notification->save();

    #	get the session
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT into notifications (subject,message,phone,created_at,updated_at) VALUES ('$subject','$message', '$phone', '$now', '$now')";
    log_action("create_notification execution : $sql", "debug_query.log");
    $result = mysqli_query($con, $sql);
    $rows = mysqli_affected_rows($con);
    mysqli_close($con);
    return $rows;
}

function get_user_menu($senderCB, $ussdString, $msIsdn)
{
    #	initialize message parameters
    $initial_message = "Welcome to the CREAM PLATFORM.\n";
    $initial_menu = $initial_message;

    if (is_white_listed($msIsdn)) {
        $initial_menu .= "1,2,3,4 or 5.\n";
        $initial_menu .= "1. BEST OF THE STREETS\n";
        $initial_menu .= "2. BID OF THE WEEK\n";
        $initial_menu .= "3. VOTING\n";
        $initial_menu .= "4. TRIVIA\n";
        $initial_menu .= "5. BID of WOW\n";
    } else {
        //$initial_menu = "Where your creative dreams come true\n";
        $initial_menu .= "Kindly enter your preferred option\n";
        $initial_menu .= "1,2 or 3.\n";
        $initial_menu .= "1. TALENT\n";
        $initial_menu .= "2. BID OF THE WEEK\n";
        $initial_menu .= "3. BID More\n";
    }
    #	default message is home menu
    $message = $initial_message . $initial_menu;
    $messageType = 1;
    $weekly_bid_cost = 100;

    #	service parameters
    $charge = false;
    $service = null;

    #	get parameters
    $network = "MTN";

    #	fetch the user session
    $session = get_ussd_session($senderCB, $msIsdn);

    #	initialize session variables
    $level = isset($session["level"]) ? $session["level"] : "";
    $service = isset($session["service"]) ? $session["service"] : "";
    $responses = isset($session["responses"]) ? $session["responses"] : "";

    if (trim($msIsdn) == "2348035666672" || trim($msIsdn) == "2348062434678") {
        //$initial_menu .= "3. BID More\n";
    }

    #	prepare menu according to the level of conversation
    if ($level == 0) {
        log_action("Level 0: Session started", "mtn_debug.log");
        #	initial level which displays the first menu
        $message = $initial_message . $initial_menu;
        $messageType = "1";
        $level = 1;
    } elseif ($level == 1) {
        #	2nd level

        if ($ussdString == "1" || $ussdString == "463*1") {
            if (is_white_listed($msIsdn)) {
                #	means user selected Best of the Streets
                //$choice = "BOTS";
                //$message = "Thanks for choosing Best of the Streets\n";
                //$messageType = "2";
                //$gift_message = "You successfully registered for Best of the Streets ".str_replace("BOTS", "Best of the Streets", $choice);
                //$charge = true;
                //$service = $choice;

                $menu = "Kindly choose your TALENT option\n";
                $menu .= "1,2,3 or 4.\n";
                $menu .= "1. BEST OF THE STREETS\n";
                $menu .= "2. DISTRIBUTION\n";
                $menu .= "3. GRANTS\n";
                $menu .= "4. FUNDING\n";

                $message = $menu;
                $messageType = "1";
                $level = "2a";
            } else {
                $message = "The service will cost you NGN 100\n";
                $message .= "1.MUSIC\n";
                $message .= "2.MOVIES\n";
                $message .= "3.FASHION\n";
                $message .= "4.ENTERPRENEUR\n";
                $message .= "5.COMEDY\n";
                $message .= "6.SCHOLARSHIP";
                $messageType = "1";
                $level = 2;
                $branch = 1;
            }
        } elseif ($ussdString == "2" || $ussdString == "463*2") {
            #	Default message for Bid under construction
            /*$message = "Sorry, Bid is not available right now.\nPlease visit creamplatform.com to bid.";
					$messageType = "2";
					$level = 3;
					$branch = 2;*/
            #	means user selected CREAM Weekly Bid
            $today = date("Y-m-d H:i:s");
            $item_count = 3;
            //$message = "Hello there";
            //$messageType = 1;
            //break;

            $items = get_today_bid_items($item_count);
            if (count($items)) {
                #	means that there are items of the week
                $message = "Items\n";
                $i = 1;
                foreach ($items as $item) {
                    $price = number_format($item["price"]);
                    $message .=
                        $i .
                        "." .
                        $item["name"] .
                        " (Value: N" .
                        $price .
                        ")\n";
                    $i++;
                }
                $messageType = "1";
                $level = 2;
                $branch = 2;
                log_action(
                    "Level 1: Bid More Product Display: $message",
                    "progress.log"
                );
            } else {
                #	means that there are no items for the week
                $message =
                    "Sorry, no product is currently open for bid.\nPlease try again later.";
                $messageType = "2";
                $level = 3;
                $branch = 2;
            }
        } elseif ($ussdString == "3" || $ussdString == "463*3") {
            if (is_white_listed($msIsdn)) {
                #	means user selected Best of the Voting
                $choice = "VOTING";
                $message = "Please enter the Unique Content ID for voting.\n";
                $messageType = "1";
                #$gift_message = "You successfully registered for $choice.";
                #$charge = true;
                $service = $choice;
                $level = 2;
                $branch = 4;
            } else {
                #	means user selected CREAM Bid More
                $item_count = 3;
                $items = get_today_bid_items($item_count);

                if (count($items)) {
                    #	means that there are items of the week
                    $message = "BID MORE Items\n";
                    $i = 1;
                    foreach ($items as $item) {
                        $price = number_format($item["price"]);
                        $message .=
                            $i .
                            "." .
                            $item["name"] .
                            " (Value: N" .
                            $price .
                            ")\n";
                        $i++;
                    }
                    $messageType = "1";
                    $level = 2;
                    $branch = 3;
                } else {
                    #	means that there are no items for the week
                    $message =
                        "Sorry, no product is currently open for bid.\nPlease try again later.";
                    $messageType = "2";
                    $level = 3;
                    $branch = 2;
                }
            }
        } elseif ($ussdString == "4" || $ussdString == "463*4") {
            if (is_white_listed($msIsdn)) {
                #	means user selected Best of the Voting
                $choice = "TRIVIA";
                $message = "Thanks for choosing TRIVIA \n";
                $messageType = "2";
                $gift_message = "You successfully registered for $choice.";
                $charge = true;
                $service = $choice;
                $level = 2;
                $branch = 5;
            } else {
            }
        } elseif ($ussdString == "5" || $ussdString == "463*5") {
            if (is_white_listed($msIsdn)) {
                #	means user selected Bid of WoW
                $choice = "BOW";
                $message = "Thanks for choosing Bid of WoW \n";
                $messageType = "2";
                $gift_message = "You successfully registered for $choice.";
                $charge = true;
                $service = $choice;
                $level = 2;
                $branch = 6;
            } else {
            }
        } else {
            $message = "Invalid option. \n";
            $message .= $initial_menu;
            $messageType = "1";
            $level = 1;
        }
    } elseif ($level == "2a") {
        $choice = "BOTS";
        if ($ussdString == "1" || $ussdString == "463*1*1") {
            #	means user selected Best of the Streets
            $choice = "BOTS";
            $message = "Thanks for choosing Best of the Streets\n";
            $messageType = "2";
            $gift_message =
                "You successfully registered for Best of the Streets " .
                str_replace("BOTS", "Best of the Streets", $choice);
            $charge = true;
        } elseif ($ussdString == "2" || $ussdString == "463*1*2") {
            #	means user selected Distribution
            $choice = "DISTRIBUTION";
            $message = "Thanks for choosing Distribution\n";
            $messageType = "2";
            $gift_message = "You successfully registered for $choice";
            $charge = true;
            $internalService = "BOTS_DISTRIBUTION";
        } elseif ($ussdString == "3" || $ussdString == "463*1*3") {
            #	means user selected Grants
            $choice = "GRANTS";
            $message = "Thanks for choosing Grants\n";
            $messageType = "2";
            $gift_message = "You have successfully registered for $choice";
            $charge = true;
            $internalService = "BOTS_GRANTS";
        } elseif ($ussdString == "4" || $ussdString == "463*1*4") {
            #	means user selected Funding
            $choice = "FUNDING";
            $message = "Thanks for choosing Funding\n";
            $messageType = "2";
            $gift_message = "You have successfully registered for $choice";
            $charge = true;
            $internalService = "BOTS_FUNDING";
        }
        $service = $choice;
    } elseif ($level == 2) {
        # 3rd level
        $messageType = "1";
        $level = 3;
        $branch = $session["branch"]; //log_action("Branch: ".$session['branch'], 'debug.log');
        switch ($branch) {
            case "1":
                #	means user selected talent
                switch ($ussdString) {
                    case "1":
                        $choice = "MUSIC";
                        break;
                    case "2":
                        $choice = "MOVIES";
                        break;
                    case "3":
                        $choice = "FASHION/LIFESTYLE";
                        break;
                    case "4":
                        $choice = "ENTERPRENEUR";
                        break;
                    case "5":
                        $choice = "COMEDY";
                        break;
                    case "6":
                        $choice = "SCHOLARSHIP";
                        break;
                    default:
                        $choice = "MUSIC";
                        break;
                }
                $message = "To register for $choice, please authorize the charge of N100.00. \nYou will receive a message shortly.\n";
                $messageType = "2";
                $gift_message = "You successfully registered for $choice";
                $charge = true;
                $service = $choice;
                break;
            case "2":
                #	means user selected cream bid
                $message =
                    "Enter your bid amount\n(lowest Amount you want to pay)\n";
                $messageType = "1";

                #	fetch the bid items
                //$cream_db = \DB::connection('cream_db');
                $item_count = 3;
                $items = get_today_bid_items($item_count);

                $i = 1;
                if (
                    is_numeric($ussdString) &&
                    $ussdString <= count($items) &&
                    $ussdString > 0
                ) {
                    foreach ($items as $item) {
                        $selected_bid_item = $item["id"];
                        if ($i == $ussdString) {
                            break;
                        }
                        $i++;
                    }

                    #	register the product
                    $new_bid = register_bid($selected_bid_item, $session["id"]);
                } else {
                    #	means that there are items of the week
                    $message = "Invalid input\n";
                    $i = 1;
                    foreach ($items as $item) {
                        $price = number_format($item["price"]);
                        $message .=
                            $i .
                            "." .
                            $item["name"] .
                            " (Value: N" .
                            $price .
                            ")\n";
                        $i++;
                    }
                    $messageType = "1";
                    $level = 2;
                    $branch = 3;
                }
                break;
            case "3":
                log_action("Level 2: Bid More Enter Bid Amount", "debug.log");
                #	means user selected cream bid
                $message =
                    "Bid More \nEnter your bid amount\n(lowest Amount you want to pay)\n";
                $messageType = "1";
                $level = "3b";
                #	fetch the bid items
                //$cream_db = \DB::connection('cream_db');
                $item_count = 3;
                $items = get_today_bid_items($item_count);
                if (
                    is_numeric($ussdString) &&
                    $ussdString <= count($items) &&
                    $ussdString > 0
                ) {
                    $i = 1;
                    foreach ($items as $item) {
                        $selected_bid_item = $item["id"];
                        if ($i == $ussdString) {
                            break;
                        }
                        $i++;
                    }

                    #	register the product
                    $new_bid = register_bid($selected_bid_item, $session["id"]);
                } else {
                    #	means that there are items of the week
                    $message = "Invalid input\n";
                    $message .= "Bid More\n";
                    $i = 1;
                    foreach ($items as $item) {
                        $price = number_format($item["price"]);
                        $message .=
                            $i .
                            "." .
                            $item["name"] .
                            " (Value: N" .
                            $price .
                            ")\n";
                        $i++;
                    }
                    $messageType = "1";
                    $level = 2;
                    $branch = 3;
                }
                break;
            case "4":
                if (is_white_listed($msIsdn)) {
                    #	means user selected Voting

                    /*try
		{
			$con1 = mysqli_connect("localhost", "ussd_store_2243", "Tdh057e7@","admin_cream_ussd_base_db");
			//log_action("Ready for DB Connection", 'mtn_madapi_datasync_play.log');
			if(mysqli_connect_errno())
			{
			   //log_action("Failed DB Connection", 'datasync.log');
				exit();
			}
      $sql="INSERT into vote1 (content_id,phone,status,channel) VALUES ('$ussdString','$msIsdn',1, 'ussd')"; 
      //log_action("create entry execution : $sql", 'mtn_madapi_datasync_play.log');
      $result = mysqli_query($con1, $sql);
      $rows = mysqli_affected_rows($con1);
      mysqli_close($con1);
      //echo $rows;
		}
		catch(Exception $e)
		{
			log_action("DB Connection Exception create_notification: $e", 'mtn_madapi_datasync_play.log');
		}*/

                    $choice = "VOTING";
                    $message = "You have opted to vote for $ussdString, \nYou will receive a prompt shortly.\n";
                    $messageType = "2";
                    $gift_message = "You have successfully voted for $ussdString at N50. Your votes count. You may vote as many times for more chances to win . Visit https://www.creamplatform.com/portal for more information.";
                    $charge = true;
                    $service = $choice;
                    postvote($msIsdn, $ussdString, "ussd");
                    break;
                }
                break;
            case "5":
                if (is_white_listed($msIsdn)) {
                    #	means user selected Voting

                    $choice = "TRIVIA";
                    $message = "To register for $choice, please authorize the charge of N100.00. \nYou will receive a message shortly.\n";
                    $messageType = "2";
                    $gift_message = "You successfully registered for $choice.";
                    $charge = true;
                    $service = $choice;
                    break;
                }
                break;
            case "6":
                if (is_white_listed($msIsdn)) {
                    #	means user selected Voting

                    $choice = "BOW";
                    $message = "To register for $choice, please authorize the charge of N100.00. \nYou will receive a message shortly.\n";
                    $messageType = "2";
                    $gift_message = "You successfully registered for $choice.";
                    $charge = true;
                    $service = $choice;
                    break;
                }
                break;
            default:
                $message = "Invalid options. \n";
                $message .= $initial_menu;
                $messageType = "1";
                $level = 1;
                break;
        }
    } elseif ($level === "3") {
        #	fetch the users bid
        $bid = fetch_user_bid($session["id"]); //\App\Models\CreamBid::where('session_id', '=', $session->id)->first();
        $level = 4;
        if ($bid) {
            if (
                is_numeric($ussdString) &&
                $ussdString > 0 &&
                $ussdString != "" &&
                $ussdString != null
            ) {
                if (preg_match('/^\d+\.\d+$/', trim($ussdString))) {
                    $message = "Bid amount must be a whole number\n";
                    $message .=
                        "Enter your bid amount\n(lowest Amount you want to pay)\n";
                    $messageType = "1";
                } else {
                    #	update the bid amount
                    $bid_amount = trim(round($ussdString));
                    $bid_amount_updated = update_bid_amount(
                        $bid["id"],
                        $bid_amount
                    ); //$bid->save();

                    //$cream_db = \DB::connection('cream_db');
                    $today = date("Y-m-d H:i:s");
                    $item = get_bid_item($bid["item_id"]);
                    //
                    $gift_message =
                        "Your bid for :" .
                        $item["name"] .
                        " at NGN " .
                        $item["price"] .
                        " has been confirmed.";
                    $wallet = get_wallet(
                        preg_replace("/^(234)/", "", trim($msIsdn))
                    );

                    if ($wallet) {
                        if ($wallet["balance"] >= $weekly_bid_cost) {
                            $message = "Please select payment method.\n";
                            $message .= "1. Airtime\n";
                            $message .= "2. CREAM Token";
                            $messageType = "1";
                            $service = "CREAM Weekly Bid";
                        } else {
                            $message =
                                "This service costs N" .
                                number_format($weekly_bid_cost, 2) .
                                ".";
                            //$message = $gift_message;
                            $messageType = "2";
                            $service = "CREAM Weekly Bid";
                            $charge = true;
                        }
                    } else {
                        $message =
                            "This service costs N" .
                            number_format($weekly_bid_cost, 2) .
                            ".";
                        //$message = preg_replace('/^(234)/', "", trim($msIsdn));
                        $messageType = "2";
                        $service = "CREAM Weekly Bid";
                        $charge = true;
                    }
                }
            } else {
                $message = "Only whole numbers are accepted\n";
                $message .=
                    "Enter your bid amount\n(lowest Amount you want to pay)\n";
                $messageType = "1";
            }
        } else {
            $message =
                "There was an error completing your bid at the moment!\n";
            $message .= "Please try again later.\n";
            $messageType = "2";
        }
    } elseif ($level == "3b") {
        log_action(
            "Level 1: Bid More Payment method or payment instruction",
            "debug.log"
        );
        #	fetch the users bid
        $bid = fetch_user_bid($session["id"]);
        $level = "4b";
        if ($bid) {
            if (
                is_numeric($ussdString) &&
                $ussdString > 0 &&
                $ussdString != "" &&
                $ussdString != null
            ) {
                if (preg_match('/^\d+\.\d+$/', trim($ussdString))) {
                    $message = "Bid amount nust be a whole number\n";
                    $message .=
                        "Enter your bid amount\n(lowest Amount you want to pay)\n";
                    //$message .= "This service costs you NGN100.00";
                    $messageType = "1";
                } else {
                    #	update the bid amount
                    $bid_amount = trim(round($ussdString));
                    $bid_amount_updated = update_bid_amount(
                        $bid["id"],
                        $bid_amount
                    );

                    //$cream_db = \DB::connection('cream_db');
                    $today = date("Y-m-d H:i:s");
                    $item = get_bid_item($bid["item_id"]);
                    $gift_message =
                        "Your bid for :" .
                        $item["name"] .
                        " at NGN " .
                        $item["price"] .
                        " has been confirmed.";
                    $wallet = get_wallet(
                        preg_replace("/^(234)/", "", trim($msIsdn))
                    );
                    if ($wallet) {
                        if ($wallet["balance"] >= $weekly_bid_cost) {
                            $message =
                                "BID MORE\nPlease select payment method.\n";
                            $message .= "1. Airtime\n";
                            $message .= "2. CREAM Token";
                            $messageType = "1";
                            $service = "CREAM Bid More";
                        } else {
                            $message =
                                "This service costs N" .
                                number_format($weekly_bid_cost, 2) .
                                ".";
                            //$message = $gift_message;
                            $messageType = "2";
                            $service = "CREAM Bid More";
                            $charge = true;
                        }
                    } else {
                        $message =
                            "This service costs N" .
                            number_format($weekly_bid_cost, 2) .
                            ".";
                        $messageType = "2";
                        $service = "CREAM Bid More";
                        $charge = true;
                    }
                }
            } else {
                $message = "Invalid bid amount\n";
                $message .=
                    "Enter your bid amount\n(lowest Amount you want to pay)\n";
                $messageType = "1";
            }
        } else {
            $message =
                "There was an error processing your bid at the moment!\n";
            $message .= "Please try again later.\n";
            $messageType = "2";
        }
    } elseif ($level === "4") {
        $level = 5;
        $service = "CREAM Weekly Bid";
        $bid = fetch_user_bid($session["id"]);
        $item = get_bid_item($bid["item_id"]);
        switch ($ussdString) {
            case "1":
                #	bidder chose airtime
                if ($bid && $item) {
                    $message =
                        "This service costs N" .
                        number_format($weekly_bid_cost, 2) .
                        ".";
                    //$message = $gift_message;
                    $messageType = "2";
                    $charge = true;

                    #	create gift message
                    $gift_message =
                        "You have successfully submitted your bid (NGN " .
                        $bid["amount"] .
                        ") for $item->name (#" .
                        $item["number"] .
                        "). Cost NGN $weekly_bid_cost from airtime via USSD.";
                } else {
                    $message =
                        "There was an error processing your bid at the moment!\n";
                    $message .= "Please try again later.\n";
                    $messageType = "2";
                    break;
                }
                break;
            case "2":
                #	bidder chose wallet
                if ($bid && $item) {
                    #	ensure wallet balance is sufficient
                    $wallet = get_wallet(
                        preg_replace("/^(234)/", "", trim($msIsdn))
                    );

                    if ($wallet) {
                        if ($wallet["balance"] >= $weekly_bid_cost) {
                            $wallet_charged = true;
                            if ($wallet_charged) {
                                $saved = register_user_bid(
                                    $bid["amount"],
                                    $item["number"],
                                    preg_replace("/^(234)/", "", trim($msIsdn)),
                                    "ACTIVE",
                                    "USSD"
                                );
                                if ($saved) {
                                    #	reconcile wallet balance
                                    $new_balance =
                                        $wallet["balance"] - $weekly_bid_cost;
                                    $wallet_updated = update_wallet_balance(
                                        $new_balance,
                                        $wallet["id"]
                                    );

                                    #	wallet transaction
                                    $amount = $weekly_bid_cost;
                                    $id_wallet = $wallet["id"];
                                    $description =
                                        "CREAM Token payment for USSD Submission of N" .
                                        number_format($bid["amount"]) .
                                        " bid for " .
                                        $item["name"] .
                                        "  (#" .
                                        $item["number"] .
                                        ")";
                                    $type = "debit";
                                    $wallet_transaction_updated = create_wallet_transaction(
                                        $amount,
                                        $id_wallet,
                                        $description,
                                        $type
                                    );

                                    #	create notification
                                    $notification_subject = "Product Bid";
                                    $notification_message =
                                        "You have successfully submitted your bid (NGN " .
                                        $bid["amount"] .
                                        ") for " .
                                        $item["name"] .
                                        " (#" .
                                        $item["number"] .
                                        "). Cost NGN $weekly_bid_cost from wallet via USSD.";
                                    $notification_phone = preg_replace(
                                        "/^(234)/",
                                        "",
                                        trim($msIsdn)
                                    );
                                    $sent_notification = create_notification(
                                        $notification_subject,
                                        $notification_message,
                                        $notification_phone
                                    );
                                    $message =
                                        "Your NGN " .
                                        number_format($bid["amount"]) .
                                        " bid for " .
                                        $item["name"] .
                                        " (#" .
                                        $item["number"] .
                                        ") has been submitted successfully!\nPayment was made via your CREAM Token!";
                                    $messageType = "2";

                                    #	send SMS
                                    send_mtn_madapi_sms(
                                        $msIsdn,
                                        $notification_message
                                    );
                                } else {
                                    $message =
                                        "Sorry, there was an error processing your bid!";
                                    $messageType = "2";
                                }
                            } else {
                                $message =
                                    "Sorry, there was an error processing your bid wallet transaction!";
                                $messageType = "2";
                            }
                        } else {
                            $message = "Your wallet balance is insufficent!";
                            $messageType = "2";
                        }
                    } else {
                        $message =
                            "Sorry, there was an error processing your bid wallet transaction!";
                        $messageType = "2";
                    }
                } else {
                    $message = "Sorry, there was an error processing your bid!";
                    $messageType = "2";
                }
                //$charge = true;
                break;
            default:
                $message =
                    "There was an error processing your bid at the moment!\n";
                $message .= "Please try again later.\n";
                $messageType = "2";
                break;
        }
        $level = 5;
    } elseif ($level == "4b") {
        log_action("Level 1: Bid More Payment Conclusion", "debug.log");
        $level = "5b";
        $service = "CREAM Bid More";
        $bid = fetch_user_bid($session["id"]);
        $item = get_bid_item($bid["item_id"]);
        switch ($ussdString) {
            case "1":
                #	bidder chose airtime
                if ($bid && $item) {
                    $message =
                        "This service costs N" .
                        number_format($weekly_bid_cost, 2) .
                        ".";
                    //$message = $gift_message;
                    $messageType = "2";
                    $charge = true;

                    #	create gift message
                    $gift_message =
                        "You have successfully submitted your bid (NGN " .
                        $bid["amount"] .
                        ") for $item->name (#" .
                        $item["number"] .
                        "). Cost NGN $weekly_bid_cost from airtime via USSD.";
                } else {
                    $message =
                        "There was an error processing your bid at the moment!\n";
                    $message .= "Please try again later.\n";
                    $messageType = "2";
                    break;
                }
                break;
            case "2":
                #	bidder chose wallet
                if ($bid && $item) {
                    #	ensure wallet balance is sufficient
                    $wallet = get_wallet(
                        preg_replace("/^(234)/", "", trim($msIsdn))
                    );

                    if ($wallet) {
                        if ($wallet["balance"] >= $weekly_bid_cost) {
                            $wallet_charged = true;
                            if ($wallet_charged) {
                                $saved = register_user_bid(
                                    $bid["amount"],
                                    $item["number"],
                                    preg_replace("/^(234)/", "", trim($msIsdn)),
                                    "ACTIVE",
                                    "USSD"
                                );
                                if ($saved) {
                                    #	reconcile wallet balance
                                    $new_balance =
                                        $wallet["balance"] - $weekly_bid_cost;
                                    $wallet_updated = update_wallet_balance(
                                        $new_balance,
                                        $wallet["id"]
                                    );

                                    #	wallet transaction
                                    $amount = $weekly_bid_cost;
                                    $id_wallet = $wallet["id"];
                                    $description =
                                        "CREAM Token payment for USSD Submission of N" .
                                        number_format($bid["amount"]) .
                                        " bid for " .
                                        $item["name"] .
                                        "  (#" .
                                        $item["number"] .
                                        ")";
                                    $type = "debit";
                                    $wallet_transaction_updated = create_wallet_transaction(
                                        $amount,
                                        $id_wallet,
                                        $description,
                                        $type
                                    );

                                    #	create notification
                                    $notification_subject = "Product Bid";
                                    $notification_message =
                                        "You have successfully submitted your bid (NGN " .
                                        $bid["amount"] .
                                        ") for " .
                                        $item["name"] .
                                        " (#" .
                                        $item["number"] .
                                        "). Cost NGN $weekly_bid_cost from wallet via USSD.";
                                    $notification_phone = preg_replace(
                                        "/^(234)/",
                                        "",
                                        trim($msIsdn)
                                    );
                                    $sent_notification = create_notification(
                                        $notification_subject,
                                        $notification_message,
                                        $notification_phone
                                    );
                                    $message =
                                        "Your NGN " .
                                        number_format($bid["amount"]) .
                                        " bid for " .
                                        $item["name"] .
                                        " (#" .
                                        $item["number"] .
                                        ") has been submitted successfully!\nPayment was made via your CREAM Token!";
                                    $messageType = "2";

                                    #	send SMS
                                    send_mtn_madapi_sms(
                                        $msIsdn,
                                        $notification_message
                                    );
                                } else {
                                    $message =
                                        "Sorry, there was an error processing your bid!";
                                    $messageType = "2";
                                }
                            } else {
                                $message =
                                    "Sorry, there was an error processing your bid wallet transaction!";
                                $messageType = "2";
                            }
                        } else {
                            $message = "Your wallet balance is insufficent!";
                            $messageType = "2";
                        }
                    } else {
                        $message =
                            "Sorry, there was an error processing your bid wallet transaction!";
                        $messageType = "2";
                    }
                } else {
                    $message = "Sorry, there was an error processing your bid!";
                    $messageType = "2";
                }
                //$charge = true;
                break;
            default:
                $message =
                    "There was an error processing your bid at the moment!\n";
                $message .= "Please try again later.\n";
                $messageType = "2";
                break;
        }
        $level = "5b";
    }
    /*else if($level == 3)
		{
			#	fetch the users bid
			$bid = \App\Models\CreamBid::where('session_id', '=', $session->id)->first();
			
			if($bid)
			{
				#	update the bid amount
				$bid->amount = $ussdString;
				$bid_amount_updated = $bid->save();
				
				
				$cream_db = \DB::connection('cream_db');
				$today = date('Y-m-d H:i:s');
				$item = $cream_db->table('bid')
						->where(['id' => $bid->item_id])
						->first();
				$gift_message = "Your bid for :".$item->name." at NGN ".$item->price." has been confirmed.";
				$wallet = \App\Models\Wallet::where('phone_number', '=', $mobile)->first();
				if($wallet->can_bid())
				{
					$message = "Please select payment method.\n";
					$message .= "1. Airtime\n";
					$message .= "2. CREAM Token";
					$messageType = "1";
					$service = "CREAM Weekly Bid";
					$charge = true;
				}
				else
				{
					$message = "To submit your bid, please authorize the charge of N100.00. \nYou will receive a message shortly.";
					//$message = $gift_message;
					$messageType = "2";
					$service = "CREAM Weekly Bid";
					$charge = true;
				}
				$level = 4;
			}
			else{
				$message = "There was an error processing your bid at the moment!\n";
				$message .= "Please try again later.\n";
				$messageType = "2";
			}

		}*/

    #	get the session
    $responses .= "|" . $ussdString;
    if (
        isset($gift_message) &&
        $gift_message &&
        (isset($internalService) || isset($service))
    ) {
        $sql =
            "UPDATE nsip_ussd_sessions SET level='$level', service = '" .
            ($internalService ?? $service) .
            "', gift_message = '$gift_message', responses= '$responses' WHERE session_id='$senderCB' AND mobile_number='$msIsdn'";
    } elseif (isset($internalService) || isset($service)) {
        if (isset($branch) && $branch) {
            $sql = "UPDATE nsip_ussd_sessions SET level='$level', branch= '$branch', responses= '$responses' WHERE session_id='$senderCB' AND mobile_number='$msIsdn'";
        } else {
            $sql =
                "UPDATE nsip_ussd_sessions SET level='$level', service = '" .
                ($internalService ?? $service) .
                "', responses= '$responses' WHERE session_id='$senderCB' AND mobile_number='$msIsdn'";
        }
    } else {
        if (isset($branch) && $branch) {
            $sql = "UPDATE nsip_ussd_sessions SET level='$level', branch= '$branch', responses= '$responses' WHERE session_id='$senderCB' AND mobile_number='$msIsdn'";
        } else {
            $sql = "UPDATE nsip_ussd_sessions SET level='$level', responses= '$responses' WHERE session_id='$senderCB' AND mobile_number='$msIsdn'";
        }
    }

    #	update the session and close database connection
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        //log_action("Ready for DB Connection", 'mtn_db_connection_exception.log');
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "session_update_db_error.log");
            exit();
        }
    } catch (Exception $e) {
        log_action(
            "Ready for DB Connection update session",
            "mtn_db_connection_exception.log"
        );
    }
    $updated = mysqli_query($con, $sql);
    mysqli_close($con);
    $data["menu"] = $message;
    $data["messageType"] = $messageType;
    $data["charge"] = $charge;
    $data["service"] = $service;
    if (isset($gift_message) && $gift_message) {
        $data["gift_message"] = $gift_message;
    }
    log_action(
        "Get Menu - $message, message-type- $messageType, Charge - $charge, Service - $service",
        "progess.log"
    );
    return $data;
}

function update_ussd_service($senderCB, $msIsdn, $service)
{
    #	means that it is a new session so create one
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "mtn_database_errors.log");
            exit();
        }
    } catch (Exception $e) {
        return false;
    }
    $sql = "UPDATE nsip_ussd_sessions SET service = '$service' WHERE session_id='$senderCB'";
    $updated = mysqli_query($con, $sql);
    mysqli_close($con);
    return true;
}

function update_payment_details($senderCB, $msIsdn, $gift_message, $service)
{
    #	means that it is a new session so create one
    try {
        $con = mysqli_connect(
            "localhost",
            "ussd_store_2243",
            "Tdh057e7@",
            "admin_cream_ussd_base_db"
        );
        log_action("Ready for DB Connection", "datasync.log");
        if (mysqli_connect_errno()) {
            log_action("Failed DB Connection", "mtn_database_errors.log");
            exit();
        }
    } catch (Exception $e) {
        return false;
    }
    $sql = "UPDATE nsip_ussd_sessions SET gift_message='$gift_message', service = '$service' WHERE session_id='$senderCB'";
    //$updated = mysqli_query($con, $sql);
    mysqli_close($con);
    return true;
}

function invoke_payment_authorization($msIsdn, $senderCB)
{
    $params["msIsdn"] = $msIsdn;
    $params["transaction_id"] = $senderCB;
    #	initiate charge
    $url = "https://www.ussd.creamplatform.com/paymentauth.php";
    $test = curl_init();
    //this will set the minimum time to wait before proceed to the next line to 100 milliseconds
    curl_setopt_array($test, [
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT_MS => 50,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $params,
    ]);
    $curl_response = curl_exec($test);
    if (curl_error($test)) {
        $response = curl_error($test);
    } else {
        $response = $curl_response;
    }
    //this line will be executed after 100 milliseconds
    curl_close($test);
    return $response;
}

function invoke_madapi_payment_authorization($msIsdn, $senderCB)
{
    $params["msIsdn"] = $msIsdn;
    $params["transaction_id"] = $senderCB;
    #	initiate charge
    $url = "https://ussd.creamplatform.com/paymentauth.php";
    $test = curl_init();
    //this will set the minimum time to wait before proceed to the next line to 100 milliseconds
    curl_setopt_array($test, [
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT_MS => 50,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $params,
    ]);
    $curl_response = curl_exec($test);
    if (curl_error($test)) {
        $response = curl_error($test);
    } else {
        $response = $curl_response;
    }
    //this line will be executed after 100 milliseconds
    curl_close($test);
    return $response;
}

function send_sms($msisdn, $message)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL =>
            "https://ussd.creamplatform.com/sms/send?address=" .
            $msisdn .
            "&msg=" .
            urlencode($message),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);
}

function send_mtn_madapi_sms($msisdn, $message)
{
    try {
        $curl = curl_init();

        $data = [
            "msIsdn" => $msisdn,
            "sms_message" => $message,
        ];

        $encodedData = json_encode($data);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://www.ussd.creamplatform.com/mtn_madapi_send_sms.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_TIMEOUT => 0,
            CURLOPT_POSTFIELDS => $encodedData,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => ["Content-Type:application/json"],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
    } catch (\Exception $e) {
        #	log the exception
    }
}
function mtn_madapi_subscription($ip, $port, $msisdn, $product_id, $service_id)
{
    $live = false;
    $node_id = "ICELL LIMITED";
    if ($live) {
        $subscription_provider_id = "CSM";
        $api_token = "90991111222335234246";
        $sp_id = "2340007090133";
        $transaction_id = $sp_id . uniqid();
    } else {
        $subscription_provider_id = "CSM";
        $api_token = "90991111222335234246";
        $sp_id = "2340007090133";
        $transaction_id = $sp_id . uniqid();
    }
    $curl = curl_init();

    if ($product_id == "23401220000031792") {
        $subscription_payload =
            '{
			   "subscriptionProviderId": "' .
            $subscription_provider_id .
            '",
				"subscriptionId": "' .
            $service_id .
            '",
				"nodeId": "' .
            $node_id .
            '",
				"subscriptionDescription": "' .
            $product_id .
            '",
				"registrationChannel" :"USSD",
				"bundleType": "Y",
				"amountCharged": "100"
			}';
    } else {
        $subscription_payload =
            '{
			   "subscriptionProviderId": "' .
            $subscription_provider_id .
            '",
				"subscriptionId": "' .
            $service_id .
            '",
				"nodeId": "' .
            $node_id .
            '",
				"subscriptionDescription": "' .
            $product_id .
            '",
				"registrationChannel" :"USSD"
			}';
    }
    //log_action("url "."http://$ip:$port/v2/customers/$msisdn/subscriptions/"."Subscription Request: $subscription_payload", 'mtn_madapi_subscription_troublehoot.log');
    curl_setopt_array($curl, [
        CURLOPT_URL => "http://$ip:$port/v2/customers/$msisdn/subscriptions/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $subscription_payload,
        CURLOPT_HTTPHEADER => [
            "transactionId: " . $transaction_id,
            "API-TOKEN: " . $api_token,
            "Content-Type: application/json",
        ],
    ]);

    $response = curl_exec($curl);
    //log_action("url "."http://$ip:$port/v2/customers/$msisdn/subscriptions/"."Subscription Request: $subscription_payload", 'trace_subscription.log');
    log_action(
        "request: " .
            $subscription_payload .
            " subscription Response: $response",
        "trace_subscription.log"
    );
    curl_close($curl);
    return $response;
}

function mtn_madapi_ondemand($ip, $port, $msisdn, $product_id, $service_id)
{
    //log_action("payload: $product_id".$msisdn, 'trace_subscription.log');
    $node_id = "ICELL LIMITED";
    $subscription_provider_id = "CSM";
    $api_token = "90991111222335234246";
    $sp_id = "2340007090133";
    $transaction_id = $sp_id . uniqid();

    $curl = curl_init();

    $subscription_payload =
        '{
			   "subscriptionProviderId": "' .
        $subscription_provider_id .
        '",
				"subscriptionId": "' .
        $service_id .
        '",
				"nodeId": "' .
        $node_id .
        '",
				"subscriptionDescription": "' .
        $product_id .
        '",
				"registrationChannel" :"USSD",
				"bundleType": "Y",
				"amountCharged": "100.0"
			}';

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://$ip:$port/v2/customers/$msisdn/subscriptions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $subscription_payload,
        CURLOPT_HTTPHEADER => [
            "transactionId: " . $transaction_id,
            "API-TOKEN: " . $api_token,
            "Content-Type: application/json",
        ],
    ]);

    $response = curl_exec($curl);
    //log_action("payload2: $product_id".$response, 'trace_subscription.log');
    //log_action("API-TOKEN:".$api_token." transactionId ".$transaction_id."url "."http://$ip:$port/v2/customers/$msisdn/subscriptions/"."ondemand Request: $subscription_payload", 'trace_subscription.log');
    log_action(
        "request: " . $subscription_payload . " ondemand Response: $response",
        "trace_subscription.log"
    );
    curl_close($curl);
    return $response;
}

function mtn_madapi_unsubscription(
    $ip,
    $port,
    $msisdn,
    $product_id,
    $service_id
) {
    $live = false;
    $node_id = "ICELL LIMITED";
    if ($live) {
        $subscription_provider_id = "CSM";
        $api_token = "90991111222335234246";
        $sp_id = "2340007090133";
        $transaction_id = $sp_id . uniqid();
    } else {
        $subscription_provider_id = "CSM";
        $api_token = "90991111222335234246";
        $sp_id = "2340007090133";
        $transaction_id = $sp_id . uniqid();
    }
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://$ip:$port/v2/customers/$msisdn/subscriptions/$service_id?subscriptionProviderId=$subscription_provider_id&nodeId=$node_id&description=$product_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => [
            "transactionId: " . $transaction_id,
            "API-TOKEN: " . $api_token,
            "Content-Type: application/json",
        ],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

function is_white_listed($msisdn)
{
    return true;
    $whitelist = [
        "2348035666672",
        "2347032059233",
        "2347030011000",
        "2348069063010",
        "2349060005406",
        "2348137313224",
        "2348061322297",
        "2347033590787",
        "2348032008456",
        "2349032020002",
        "2348032002640",
        "2348138813383",
        "2348032001970",
    ];
    return in_array($msisdn, $whitelist);
}
