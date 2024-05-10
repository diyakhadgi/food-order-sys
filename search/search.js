$(document).ready(function(){
    var initialContent = $('.results').html();
    $('#searchBox').on('keydown', function(){
        var searchText = $(this).val();
        if (searchText !== '') {
            $.ajax({
                url:'http://localhost/food-order-sys/search/search.php',
                type:'POST',
                data: {
                    query: searchText
                },
                success: function(data){
                    $('.results').html(data);
                }
            });
        }else {
            // If search box is empty, restore the initial content
            $('.results').html(initialContent);
        }
    });
});




