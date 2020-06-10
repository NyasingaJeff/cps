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
                    Town
                  </th>
                  <th>
                    Street
                  </th>
                  <th>
                    Slot
                  </th>
                  <th>
                    Paid
                  </th>
					</tr>
						</thead>
						<tbody>
            @foreach ($records as $record)
                  <tr>
                    <td>
                    {{$record->created_at->format('Y.m.d')}}
                    </td>
                    <td>
                    {{$record->space->location}}
                    </td>
                    <td>
                        {{$record->space->street}}
                    </td>
                    <td>
                        {{$record->space->st_id}}
                    </td>
                    <td>
                      {{$record->space->price}}
                  </td>

                  </tr>  
            @endforeach
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td text-color="red">Totals</td>
                  <td>{{$totals}}</td>
                  </tr>
          
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

