@extends('layouts.app')

@section('content')
  <div class="col-md-10">
    <div class="row">
      <div class="col-md-12">
          <div class="card"> <!-- start card -->
            <h5 class="card-header">
            <i class="fa fa-clipboard"></i> Lista de tareas <a href="{{ url('admin/assignments/create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Asignar nueva tarea</a></h5>
            <div class="card-body"> <!-- Start card-body -->
              @include('layouts.status')
              
              <form method="GET" action="" class="form-inline">
                  <div class="input-group mb-0">
                      <input type="text" name="search" class="form-control form-control-sm" placeholder="Buscar" aria-label="" aria-describedby="button-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-success btn-sm" type="submit" id="button-addon2">Buscar</button>
                      </div>
                  </div>
              </form>
              <hr />

              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre </th>
                            <th scope="col">Creado</th>
                            <th scope="col">Actualizado</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($assignments as $assignment)
                        <tr>
                        <td>{{ $assignment->name }}</td>
                        <td><small>{{ date("F jS, Y", strtotime($assignment->created_at)) }}</small></td>
                        <td><small>{{ date("F jS, Y", strtotime($assignment->updated_at)) }}</small></td>
                        <td>{{ $assignment->period->shortname }}</td>
                        <td><span class="badge badge-info">{{ $assignment->user->firstname }}</span></td>
                        <td>
                            @if($assignment->status == 1)
                            <span class="badge badge-success">Concluido</span>
                            @else
                            <span class="badge badge-warning">Pendiente</span>
                            @endif
                        </td>
                        <td><a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Ver</a>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_assignment_{{ $assignment->id }}"><i class="fas fa-trash"></i> Eliminar</button></td>
                        </tr>

                        @include('admin.assignments.delete')

                        @endforeach
                    </tbody>
                  </table>
              </div>

            </div> <!-- End card-body -->

            <div class="card-footer bg-transparent">
                <ul class="pagination pagination-sm justify-content-end">
                    {{ $assignments->appends(['search' => $s_assignment])->links() }}
               </ul>
            </div> <!-- End card-footer -->

          </div> <!-- End card -->
      </div>
    </div> <!-- End Row -->
  </div> <!-- End col-md-10-->
@endsection