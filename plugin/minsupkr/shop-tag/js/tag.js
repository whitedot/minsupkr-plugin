$(function() {

    // 태그 입력 및 값 가져오기
    var $coTags = $(".co_tags");

    $coTags.tagit({
        removeConfirmation: true
    });

    $(".tag_submit").click(function(){

        $(".co_tags").each(function(){
            var $this = $(this);
            var coTagName = $this.data("name");
            tag = $this.tagit("assignedTags");
            $("form").append('<input type="hidden" name="'+coTagName+'" value="'+tag+'" >');
        });

    });

});