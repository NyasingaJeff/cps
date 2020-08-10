<p> Hello Mr/Mrs {{$task->name}}</p>
<p> We Hope this finds you well..  </p>
@component('mail::panel')
<p> Folowing your placing of the towing request for your car {{strtoupper($task->no_plate )}} request on {{$task->created_at}}, To cancel the request Click the button below... </p>
@endcomponent
@component('mail::button', ['url' => 'cps.drop.com', 'color' => 'success'])
    Edit or Cancel Towing Request 
@endcomponent
<p> To Edit or Cancel click on the above link </p>
<p> Regards </p>
<p> Online Carpark System </p>