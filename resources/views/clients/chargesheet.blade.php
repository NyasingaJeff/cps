<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report for  {{$client->no_plate}}</title>
</head>
@php
 
 
    
@endphp
<body>
    <div class='row' bg='red'>
      <h4>Plate:{{$client->no_plate}}</h4>
        <h4>Owner:{{$client->name}}</h4>
        <h4>Phone Number:{{$client->phone}}</h4>
        @if (isset($client->email))
            <h4>Email:{{$client->email}}</h4>
        @else
        <h4>Email:Not Provided</h4>
        @endif
        
    </div>

    <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                 
                </thead>
                <tbody>
               
                </tbody>
              </table>
            </div>
            <div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
              <th>
                    Date
                  </th>
                  <th>
                    Location
                  </th>
                  <th>
                    Offence
                  </th>
                  <th>
                    Fine
                  </th>
                  <th>
                    Paid
                  </th>
					</tr>
						</thead>
						<tbody>
            @foreach ($offences as $offence)
                  <tr>
                    <td>
                    {{$offence->created_at->format('Y.m.d')}}
                    </td>
                    <td>
                    {{$offence->location}}
                    </td>
                    <td>
                        {{$offence->crime->name}}
                    </td>
                    <td>
                        {{$offence->fine_due}}
                    </td>
                    <td>
                    @if ($offence->trashed)
                        {{$offence->deleted_at}}
                    @else
                        {{"Not Paid"}}
                    @endif
                    </td>
                   

                  </tr>  
            @endforeach
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >Pending</td>
                  <td>KSH:{{$totalFines}}</td>
                  </tr>
          
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
    <div class="footer"  >
    <p style="text-align:left;font-size:17px;font-family:"Brushstroke, fantasy;;"><small>SE NO:CS.{{$client->no_plate.'.'.date("d.m.Y.H.i.s").'.'}}</small></p>
    </div>
</body>
</html>

