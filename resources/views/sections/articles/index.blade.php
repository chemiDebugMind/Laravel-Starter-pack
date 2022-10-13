@extends('layouts.app')

@section('title','Articles')
    
@section('content')
    <table class="table table-bordered  articles-table">
        <thead class="thead-inverse">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
    </table>

    <div class="modal fade" id="modal-danger-article">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Delete Article</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to remove this Article?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light deleteArticle" >OK</button>
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
        $(function () {
          var articleId  = 0;

          var table = $('.articles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('articles.index') }}",
            columns:[
                {data: 'title', name:'title'},
                {data: 'author', name:'author'},
                {data: 'categories', name:'categories'},
                {data: 'action', name:'action', orderable:false, searchable:false}


            ]
          });

          $('body').on('click','.deletes', function () {
              articleId = $(this).data('id');
          });

          $('.deleteArticle').click(function (e) { 
              $.ajax({
                type: "DELETE",
                url: 'articles/'+articleId,
                data: {
                  "id":articleId,
                  "_token":"{{ csrf_token() }}"
                },
                beforeSend:function(){
                    $('.deleteArticle').text('Deleting...');
                },
                success: function (response) {
                  setTimeout(function () {
                    $('#modal-danger-article').modal('hide');
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
                      $('#modal-danger-article').modal('hide');
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