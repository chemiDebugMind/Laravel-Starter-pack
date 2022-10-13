@extends('layouts.app')

@section('title','Categories')
    
@section('content')
    <div class="row m-2">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <h4>Create New Category</h4>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" >Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ old('name') }}">
                    @error('name')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                  <div class="form-group">
                  <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('description') }}" rows="3"></textarea>
                    @error('description')
                    <small id="helpId" class="text-danger">{{ $message }}</small>
                  @enderror  
                </div>
                 
                
                <div class="form-group">
                  <label for="">Parent Category</label>
                  <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="">
                    <option value="">None</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                    @error('category_id')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="container">
                <table class="table table-hover table-bordered category-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="modal-danger-category">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Delete Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to remove this Category?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light deleteCategory" >OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    
@endsection

@push('scripts')
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>

    <script type="text/javascript">
          $(document).ready(function () {
            var categoryId  = 0;
            // Categories data table
            var table = $('.category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

               // Category delete
          $('body').on('click','.deletes', function () {
              categoryId = $(this).data('id');
          });

          $('.deleteCategory').click(function (e) { 
              $.ajax({
                type: "DELETE",
                url: 'categories/'+categoryId,
                data: {
                  "id":categoryId,
                  "_token":"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    $('.deleteCategory').text('Deleting...');
                },
                success: function (response) {
                  setTimeout(function () {
                    $('#modal-danger-category').modal('hide');
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
                      $('#modal-danger-category').modal('hide');
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