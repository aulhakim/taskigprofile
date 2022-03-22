@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="row list_feeds">

                       
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row"><img src="" alt="" id="modal_img" width="100%"></div>
            <div class="row">
                <h3 class="txt-caption"></h3>
            </div>
        </div>
        <div class="modal-footer">

            <form action="javascript:void(0)" id="formMedia" method="POST">
                @csrf
                <input type="hidden" id="link_image" name="link_image">
                <input type="hidden" id="description" name="description">
            
              <button type="submit" class="btn btn-primary">Save to database</button>
        </form>
        </div>
      </div>
    </div>
  </div>

<script>
    $.ajax({
            url:'https://graph.instagram.com/me/media?fields=id,username,media_url,caption,timestamp&access_token=IGQVJVV2ZAHZAVprc1NGbzhRcGtrM19qUEREWFV2MjZAMTVpvbDExRFRpQ1B3eC0xNXZALTmVIeWphcU15eXhQaEdRd0M4VUJnVzE5YVNPZAVdRSkk5NHJzQ1lZAR0NOcjRxejROTnV2eUZAhZADNHb1RnUTZAhRgZDZD',
            type:'GET',
            dataType:'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
                var html = '';
                $.each(data.data,function(i,val){
                        html += '<div class="card" style="width: 18rem;"><img class="card-img-top" src="'+val.media_url+'" alt="Card image cap"><div class="card-body"><h5 class="card-title">'+val.caption+'</h5><p class="card-text">'+val.timestamp+'</p><a href="#" onclick="open_modals(\' '+val.media_url+' \',\' '+val.caption+' \')"  class="btn btn-primary">Show modal</a></div></div>'}
                    );
                $('.list_feeds').html(html);
            },
        }); 

        function open_modals(params,capt){
            $('#exampleModal').modal('show');
            $('#modal_img').attr('src',params);
            $('.txt-caption').text(capt);

            $('#link_image').val(params);
            $('#description').val(capt);

        }

        $('#closemodal').click(function(){
           $('#exampleModal').modal('hide');
        });

        $('#formMedia').submit(function(){
            $.ajax({
                url:'{{ route('post.media') }}',
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:$(this).serialize(),
                success:function(data){
                    alert('Success');
                    $('#exampleModal').modal('hide');
                },
            });
        });
</script>




@endsection


