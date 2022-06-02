$(document).ready(function(){
    $("body").click(function(e){
        if(e.target.closest(".ments") != null){

            let postID = $(e.target.closest(".ments")).data("id");
            console.log(postID);
            window.location.href ="viewpost.php?postID="+postID;
        }
    });
});