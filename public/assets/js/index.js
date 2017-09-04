$(document).ready(function () {
    var $idArticle = $('#id_article').html(),
        $views = $('#vizualizari').html();

    $.ajax({
        url: "http://localhost/DB/increment/" + $idArticle + '/' + $views,
        type: "get",
        success: function (response) {
            $('#vizualizari').html(response);
        }
    })
})


$('#search').on('input', function (event) {
    var inputValue = $('#search').val();

    $.ajax({
        url: "http://localhost/DB/index.php/",
        type: "get",
        data: {
            action: "ArticleController_searchArticle",
            inputValue: inputValue
        },
        success: function (response) {
            $('#display').html(JSON.parse(response).viewArticles);

            $('#number').html("Number of articles :" + JSON.parse(response).numberOfArticles);
        }
    })
});

$('.deleteArticle').click(function () {
    var element = this;
    var partsOfStr = (this.id).split(',');
    $.ajax({
        url: "http://localhost/DB/index.php?action=ArticleController_deleteArticle",
        type: "post",
        data: {
            id: partsOfStr[0],
            id_user: partsOfStr[1]
        },
        success: function (response) {
            if(response.indexOf("No Permission")){
            }else if(response) {
                $(element).closest('tr').fadeOut(400, function () {
                    $(this).remove;
                });
            }else{
                alert("Error");
            }
        }
    })
})

$('.deleteCategory').click(function () {
    var element = this;

    $.ajax({
        url: "http://localhost/DB/index.php?action=ArticleController_deleteCategory",
        type: "post",
        data: {
            id: this.id
        },
        success: function (response) {
            $(element).closest('tr').fadeOut(400, function () {
                $(this).remove;
            });
        }
    })
})

