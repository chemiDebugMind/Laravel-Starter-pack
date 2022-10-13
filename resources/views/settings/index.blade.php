@extends('layouts.app')

@section('title','Setting')
    
@section('content')
<div class="row ml-2">
    <div class="col-12 col-sm-12">
      <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
          <ul class="nav nav-tabs" id="settingTabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="users-tab" data-toggle="pill" href="#users" role="tab" aria-controls="users" aria-selected="false">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="roles-tab" data-toggle="pill" href="#roles" role="tab" aria-controls="roles" aria-selected="false">Roles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Others</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
            </div>
            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
               <div class="row">
                    <div class="col-sm-4">
                        <h4>Create User</h4>
                        <form action="{{ route('users.store') }}" method="post">
                          @csrf
                            {{-- Name field --}}
                            <div class="row m-2">
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="input-group mb-3">
                                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                          value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                  
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                          </div>
                                      </div>
                  
                                      @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                  
                                  {{-- Email field --}}
                                  <div class="input-group mb-3">
                                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                          value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                  
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                          </div>
                                      </div>
                  
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                  
                                  {{-- Password field --}}
                                  <div class="input-group mb-3">
                                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                          placeholder="{{ __('adminlte::adminlte.password') }}">
                  
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                          </div>
                                      </div>
                  
                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                  
                                  {{-- Confirm password field --}}
                                  <div class="input-group mb-3">
                                      <input type="password" name="password_confirmation"
                                          class="form-control @error('password_confirmation') is-invalid @enderror"
                                          placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                  
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                          </div>
                                      </div>
                  
                                      @error('password_confirmation')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                  {{-- Select role --}}
                                  <div class="input-group mb-3">
                                      <select class="form-control  @error('roles') is-invalid @enderror" name="roles" id="">
                                          <option value="">Select Role</option>                                                                                                      
                                          @foreach ($roles as $role)
                                              <option value="{{ $role->id }}" >{{ $role->name}}</option>                                                                                                      
                                          @endforeach
                                      </select>
                  
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-tasks {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                          </div>
                                      </div>
                  
                                      @error('roles')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                  
                                  {{-- Register button --}}
                                  <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                      <span class="fas fa-user-plus"></span>
                                      {{ __('adminlte::adminlte.register') }}
                                  </button>
                              </div>
                            </div>
                        </form>
                        {{-- <a id="" class="btn btn-primary" href="{{ route('users.create') }}" role="button">Create User</a> --}}

                    </div>
                    <div class="col-sm-8">
                        <div class="card card-info mt-3">
                            <div class="card-body p-0">
                                <ul class="list-group">
                                    @foreach ($users as $user)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                              <p>
                                                {{ $user->name }} 
                                                <a href="{{ route('users.edit',$user->id) }}"> 
                                                  <i  class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                              </p> 
                                            

                                            <div class="form-group">
                                              <select class="form-control" name="role" id="">
                                                <option value="">Select Role</option>                                                                                                      
                                                @foreach ($roles as $role)
                                                  @if ($user->hasRole($role->name))
                                                    <option value="{{ $role->id }}" selected>{{ $role->name}}</option>                                                                                                       
                                                  @else
                                                    <option value="{{ $role->id }}" >{{ $role->name}}</option>                                                                                                      
                                                  @endif
                                                @endforeach
                                              </select>
                                            </div>
                                                
                                            <button type="button" class="btn deleteUser" data-toggle="modal" data-id="{{ $user->id }}" data-target="#modal-danger-user">
                                              <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </li> 
                                    @endforeach
                                    
                                  </ul>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
               </div>
            </div>
            <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
              <div class="row">
                <div class="col-sm-4">
                    <h4>Create Roles</h4>
                    <form action="{{ route('roles.store') }}" method="post">
                      @csrf
                      <div class="row m-2">
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <label for="">Name</label>
                                  <input type="text"
                                  class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Role Name">
                                  @error('name')
                                      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                  @enderror
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <strong>Permission:</strong>
                                  <br/>
                                  @foreach($permission as $value)
                                      <div class="form-check">
                                      <label class="form-check-label">
                                          <input type="checkbox" class="form-check-input" name="permission[]" id="" value="{{$value->name}}">
                                      {{ $value->name }}
                                      </label>
                                      </div>
                                  <br/>
                                  @endforeach
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                  </form>

                </div>
                <div class="col-sm-8">
                    <div class="card card-info">
                        <div class="card-body p-0">
                          <table class="table table-bordered">
                            <tr>
                               <th>Name</th>
                               <th width="280px">Action</th>
                            </tr>
                              @foreach ($roles as $key => $role)
                              <tr>
                                  <td>{{ $role->name }}</td>
                                  <td>
                                      @can('role-edit')
                                          <a class="btn" href="{{ route('roles.edit',$role->id) }}"> 
                                             <i style="color: blue" class="fas fa-edit" aria-hidden="true"></i>
                                          </a>
                                      @endcan
                                      @can('role-delete')
                                          <button type="button" class="btn  deleteRole" data-toggle="modal" data-id="{{ $role->id }}" data-target="#modal-danger">
                                            <i style="color:red" class="fa fa-trash" aria-hidden="true"></i>
                                            
                                          </button>
                                      @endcan
                                  </td>
                              </tr>
                              @endforeach
                          </table>
                          
                          
                          {{ $roles->links() }}
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
           </div>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
               Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this Role?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-light deleteUserSure deleteRoleSure" >OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-danger-user">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to remove this User?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-light deleteUserSure" >OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection

@push('scripts')
    <script type="text/javascript">
      $(document).ready(function () {
        var roleId = 0;
        var userId = 0;
        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });

        $('#settingTabs a').click(function(e) {
          e.preventDefault();
          $(this).tab('show');
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#settingTabs a[href="' + hash + '"]').tab('show');

        // On delete role
        $(".deleteRole").click(function (e) { 
          roleId = $(this).data('id');
        });

        $(".deleteRoleSure").click(function (e) { 
          $.ajax({
            type: "DELETE",
            url: "roles/"+roleId,
            data:{
              "id" : roleId,
              "_token":"{{ csrf_token() }}"
            },
            success: function (response) {
              setTimeout(function () {
                $('#modal-danger').modal('toggle');
                Toast.fire({
                  icon: 'success',
                  title: response.success
                });
                }, 2000); 
                setTimeout(() => {
                  window.location.reload();
                }, 1000);
                },
              error: function(response){
                setTimeout(function () {
                  $('#modal-danger').modal('toggle');
                  Toast.fire({
                    icon: 'error',
                    title: response.error
                  });
                }, 1000); 
                setTimeout(() => {
                  window.location.reload();
                }, 1000);
              }
          });
        
        });


        //On delete user
        $('.deleteUser').click(function (e) { 
          userId = $(this).data('id');
          
        });

        $('.deleteUserSure').click(function (e) { 
          $.ajax({
            type: "DELETE",
            url: 'users/'+userId,
            data: {
              "id":userId,
              '_token':"{{ csrf_token()}}",
            },
            success: function (response) {
              setTimeout(function () {
                $('#modal-danger-user').modal('toggle');
                Toast.fire({
                  icon: 'success',
                  title: response.success
                });
                }, 2000); 
                setTimeout(() => {
                  window.location.reload();
                }, 1000);
            },
            error: function(response){
              setTimeout(function () {
                $('#modal-danger-user').modal('toggle');
                Toast.fire({
                  icon: 'error',
                  title: response.error
                });
              }, 2000); 
              setTimeout(() => {
                window.location.reload();
              }, 1000);
            }
          });
          
        });
      });
    </script>
@endpush
