<p>Hello Mr/Mrs {{$task->name}}</p>
<p>We Hope this finds you well..  </p>
<p>Folowing your placing of the towing  of your car {{$task->plate }}request on {{$task->created_at}}, we are sending you the following link... </p>
@component('mail::button', ['url' => 'cancelthetow.me', 'color' => 'success'])
Edit or Cancel Towing Request 
@endcomponent
<p>To Edit or Cancel click on the above link </p>
<p>Regards </p>
<p>Online Carpark System </p>