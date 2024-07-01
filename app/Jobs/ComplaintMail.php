<?php

namespace App\Jobs;

use CodeIgniter\Queue\BaseJob;
use CodeIgniter\Queue\Interfaces\JobInterface;

class ComplaintMail extends BaseJob implements JobInterface
{
    /**
     * @throws \Exception
     */
    protected int $retryAfter = 30;
    protected int $tries      = 5;
    public function process()
    {
        $orders = new \App\Models\Orders();
        $get_details  = $orders->join('auth_identities', 'orders.user_id=auth_identities.user_id')->find($this->data['order_id']);
        $get_details['comments'] = $this->data['comments'];
        send_email($get_details['email'], 'Regret For Inconvenience Caused', $get_details, 'email_templates/user_complaint.php');
        send_email('aakasht1908@gmail.com', $this->data['subject'], $get_details, 'email_templates/admin_complaint.php');
    }
}
