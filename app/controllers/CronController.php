<?php

/**
 * Cron Job Controller for Automated Tasks
 * @category  Controller
 */
class CronController extends BaseController
{
    /**
     * Close expired bids
     * This should be called by cron job periodically (e.g., every 5 minutes)
     * @return void
     */
    function close_expired_bids()
    {
        $db = $this->GetModel();

        // Get all active bids that have been activated
        $sql = "SELECT a.bidid, a.created_at, a.status, a.points as active_points, 
				b.open_date, b.id as bid_id, b.status as bid_status
				FROM carrygo_bid_active a
				INNER JOIN carrygo_bid b ON b.id = a.bidid
				WHERE a.status = 0 AND b.status = 0";

        $active_bids = $db->rawQuery($sql);

        $closed_count = 0;
        $errors = array();

        foreach ($active_bids as $bid) {
            try {
                $dayinpass = strtotime($bid['created_at']);
                $today = strtotime("Y-m-d H:i:s");

                // Calculate hours elapsed since bid was activated
                $hours_elapsed = floor(abs($today - $dayinpass) / 60 / 60);

                // Check if the open_date period has elapsed
                if ($hours_elapsed >= $bid['open_date']) {
                    // Get the bidder with highest points for this bid
                    $bid_entry_points = $db->rawQueryOne(
                        "SELECT SUM(points) as bid_entry_points, msisdn 
						 FROM carrygo_bid_entry 
						 WHERE bidid = {$bid['bidid']} 
						 GROUP BY msisdn 
						 ORDER BY bid_entry_points DESC 
						 LIMIT 1"
                    );

                    if (!empty($bid_entry_points)) {
                        // Insert winner record
                        $db->insert('carrygo_bid_winners', array(
                            "msisdn" => $bid_entry_points['msisdn'],
                            "bidid" => $bid['bidid'],
                            "total_points" => $bid_entry_points['bid_entry_points']
                        ));

                        // Update bid status to closed (status = 2)
                        $db->where('id', $bid['bidid']);
                        $db->update('carrygo_bid', array("status" => 2));

                        // Update active bid status to closed (status = 1)
                        $db->where('bidid', $bid['bidid']);
                        $db->update('carrygo_bid_active', array(
                            "points" => $bid_entry_points['bid_entry_points'],
                            "status" => 1
                        ));

                        $closed_count++;
                    }
                }
            } catch (Exception $e) {
                $errors[] = "Error processing bid {$bid['bidid']}: " . $e->getMessage();
            }
        }

        // Log the result
        $log_message = date('Y-m-d H:i:s') . " - Closed {$closed_count} expired bid(s)";
        if (!empty($errors)) {
            $log_message .= " - Errors: " . implode(", ", $errors);
        }
        $log_message .= "\n";

        $log_file = __DIR__ . '/../../cron_log.txt';
        error_log($log_message, 3, $log_file);

        // Return JSON response (useful for testing)
        render_json(array(
            "success" => true,
            "closed_count" => $closed_count,
            "errors" => $errors,
            "timestamp" => date('Y-m-d H:i:s')
        ));
    }
}
