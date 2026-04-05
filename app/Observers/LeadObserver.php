<?php

namespace App\Observers;

use App\Models\Lead;
use App\Models\Customer;
use App\Services\LeadToCustomer;

class LeadObserver
{
    public function updated(Lead $lead): void
    {
        if (! $lead->wasChanged('status')) {
            return;
        }

        if ($lead->status !== Lead::STATUS_WON) {
            return;
        }

        // Avoid duplicate creation
        $alreadyExists = Customer::where('lead_id', $lead->id)->exists();
        if ($alreadyExists) {
            return;
        }

        // Create customer from lead
        app(LeadToCustomer::class)->createCustomerFromLead($lead);
    }
}
