
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
          $("#pagetemp").change(function(){
              var name = $(this).val(); 
        
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{@csrf_token()}}'
                    },
                    type: "post",
                    url: 'getlpage',
                    data: {'name':name},
                    success: function (data) {
                                $('#simp').html(data);
                             }
                });
                
            });
        });
</script>
