@extends('layouts.app', ['activePage' => 'record-management', 'titlePage' => __('Records Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Records') }}</h4>
                <p class="card-category"> {{ __('Here you can manage records') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('records.create') }}" class="btn btn-sm btn-primary">{{ __('Book Space') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Plate') }}
                      </th>
                      <th>
                        {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Phone Number') }}
                      </th>
                      
                      <th class="text-right">
                        {{ __('Date') }}
                      </th>
                      {{-- usse logic to extract the space location --}}
                      <th class="text-right">
                        {{ __('Location') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($records as $record)
                        <tr>
                          <td>
                            {{ $record->no_plate }}
                          </td>
                          <td>
                            {{ $record->name }}
                          </td>
                          <td>
                            {{ $record->created_at->format('Y-m-d H:i:s') }}
                          </td>
                          <td class="td-actions text-right">
                           
                              <form action="{{ route('records.destroy', $record) }}" method="post">
                                  @csrf
                                  @method('delete')
                              
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('records.edit', $record) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this record?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                           
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('record.edit') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                         
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection