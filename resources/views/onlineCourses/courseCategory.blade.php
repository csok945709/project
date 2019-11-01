<script>
$(document).ready(function(){
    
    $('#courseCat').on('change',function(){
        var Catvalue = $("#courseCat option:selected").val();
        // console.log(Catvalue);

        $.ajax({
            type: 'get',
            dataType: 'html',
            url: "/courseCat/",
            data: 'catId=' + Catvalue,
            success:function(response){
                var data = JSON.parse(response);
                console.log(data);
                $.each(data, function(index, el) { 
                    alert(el);
                });
                            
                $("#coursesDiv").html(data);
            }
        });
    }); 
    $("#cat3").click(function(){
        alert('cliked');
    });    
}); 
</script>

{{-- @foreach(App\Course_Category::all() as $courseCategory)
@endforeach --}}