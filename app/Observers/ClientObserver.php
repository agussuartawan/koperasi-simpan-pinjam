<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        //
    }

    public function creating(Client $client)
    {
        $client_type = $client->client_type_id;
        dd($client_type);
        $client_count = Client::where('client_type_id', $client_type)->count();

        if($client_type == Client::ANGGOTA){
            $prefix = 'NSBH';
        }else if($client_type == Client::NASABAH){
            $prefix == 'ANGT';
        }

        if($client_count == 0){
            $number = 1001;
            $fullnumber = $prefix . $number;
        } else {
            $number = Client::all()->last();
            $number_plus = (int)substr($number->code, -4) + 1;
            $fullnumber = $prefix . $number_plus;
        }
        $client->code = $fullnumber;
    }

    /**
     * Handle the Client "updated" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        
    }

    /**
     * Handle the Client "deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
