<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report for Slot number {{$space->st_id}}</title>
</head>
@php
$abreviation = str_split($space->st_id,4);
$abreviation = $abreviation[1]
@endphp
<body>
    <div class='row'>
        <h2>Location:{{$space->location}}</h2>
        <h2>Street:{{$space->street}}</h2>
        <h2>Slot number:{{$abreviation}}</h2>
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
                    Plate
                  </th>
                  <th>
                    Client Name
                  </th>
                  <th>
                    Parking Time
                  </th>
							</tr>
						</thead>
						<tbody>
            @foreach ($space->record as $record)
                  <tr>
                    <td>
                    {{$record->no_plate}}
                    </td>
                    <td>
                    {{$record->name}}
                    </td>
                    <td class= 'text-primary'>
                    {{$record->created_at->diffForHumans()}}
                    </td>                    
                  </tr>
           @endforeach 
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

