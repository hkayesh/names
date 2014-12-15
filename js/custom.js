function getImages(inputWord) {
    var buttons = "<a class='btn btn-lg btn-success js-shuffle' href='javascript:void(0);' onclick='shuffleImages()'>Shuffle Letters</a>"
        + " <a class='btn btn-lg btn-success ' href='javascript:void(0);' onclick='clearWord()'>Clear Name</a>";

    var request = $.ajax({
        url: "php/nameGenerator.php",
        type: "POST",
        dataType: "html",
        data: {
            strWord: inputWord
        }
    });

    request.done(function(response) {
        $(".js-word-content").html(response);
        $(".js-buttons").html(buttons);
        $(".js-word-box-title").html('<h2>Click to change images!</h2>');
    });

    request.fail(function(jqXHR, errMeggage) {
        alert( "Request failed: " + errMeggage );
    });
}

function shuffleImages() {
    var word = $('.js-hidden-word').val();
    getImages(word);
}

function getImagesToRemove() {
    var letter = $('.js-remove-letter').val();
    $.ajax({
        url: "php/getRemoveImage.php",
        type: "POST",
        data: {
            strLetter: letter
        },
        dataType: "html",
        success: function(data)
        {
            $('.js-to-remove-content').removeClass('hidden');
            $('.js-image-content').html(data);
        },
        error: function()
        {
        }
    });
}

function removeImage(strPath, strName) {
    $.ajax({
        url: "php/removeImage.php",
        type: "POST",
        data: {
            strPath: strPath
        },
        dataType: "html",
        success: function(data)
        {
            $(".js-image-content").find("img[name$='"+ strName +"']").remove();
        },
        error: function()
        {
        }
    });
}

function clearWord() {
    var button = "<div class='text-warning'>Enter only letters or *</div><br><a class='btn btn-lg btn-success js-submit-word' href='javascript:void(0)'>Create My Name</a>";
    var inputForm = "<form action='javascript:void(0)' method='post'>"
        + "<input type='text' name='word' class='word js-word' maxlength='12' autocomplete='off'/></form>";

    $(".js-word-box-title").html('<h2>Enter your name</h2>');
    $(".js-word-content").html(inputForm);
    $(".js-buttons").html(button);
}

function viewAllImages(letter, toReplaceIndex) {
    $.ajax({
        url: "php/viewAllImages.php",
        type: "POST",
        data: {
            strLetter: letter
            , strToReplaceIndex: toReplaceIndex
        },
        dataType: "html",
        success: function(data)
        {
            $(".js-view-all-images").html(data);
        },
        error: function()
        {
        }
    });
}

$(document).ready(function(){
    $('.js-user-image, .js-letter').change(function() {
        $('.js-error, .js-success').addClass('hidden');
        if($('.js-letter').val() && $('.js-user-image').val()){
            $('.js-submit').removeAttr('disabled');
        }
    });

    $('.js-reset').click(function(){
        $('.js-submit').attr('disabled', 'disabled');
    });
});

$(document).on('click','.js-submit-word', function(){
    var word = $('.js-word').val();
    $('.js-error').addClass('hidden');
    if(word.length > 0 && word.match(/^[a-zA-Z\*]+$/)) {
        getImages(word);
    }
    else {
        $('.js-error').removeClass('hidden');
    }
});

$(document).on('click','.js-letter-image', function(){
    var letter = $(this).attr('data-letter');
    var toReplaceIndex = $(this).attr('data-index');
    viewAllImages(letter, toReplaceIndex);
});

$(document).on('click','.js-replace-image', function(){
    var letter = $(this).attr('data-letter');
    var imageName = $(this).attr('id');
    viewAllImages(letter);
});

$(document).on('click','.js-replace-with', function(){
    var toBeReplacedIndex = $(this).attr('data-to-replace-index');
    var varReplaceWithImageName = $(this).attr('name');
    var varReplaceWithImageSrc = $(this).attr('src');
    var toReplaceElement = $('.js-word-content').find('img:eq('+toBeReplacedIndex+')');
    $(toReplaceElement).attr('src', varReplaceWithImageSrc);
    $(toReplaceElement).attr('name', varReplaceWithImageName);
});

$(document).on("keydown", '.js-word',function(e){
    var key = e.which;
    if (key == 13) {  // Enter pressed
        var word = $('.js-word').val();
        $('.js-error').addClass('hidden');
        if(word.length > 0 && word.match(/^[a-zA-Z\*]+$/)) {
            getImages(word);
        }
        else {
            $('.js-error').removeClass('hidden');
        }
    }
});