// const ul = document.querySelector("ul"),
// input = ul.querySelector("input");

// let tags = [];

// function createTag(){
//     tags.forEach(tag => {
//         let liTag = `<li> ${tag} <i class="fa-solid fa-xmark"></i></li>`;
//         ul.insertAdjacentHTML("afterbegin", liTag);
//     });
// }

// function addTag(e){
//     if(e.key == "Enter"){
//         let tag = e.target.value.replace(/\s+/g, ' ');
//         if(tag.length > 1 && !tags.includes(tag)){
//             tag.split(',').forEach(tag => {
//                 tags.push(tag);
//                 createTag();
//             });
//         }
//         e.target.value = "";
//     }
// }

// input.addEventListener("keyup", addTag);


//working code for ratemylab review

// function render(data){
//     var html = "<div class='student-rating-container'><div class='left-panel'><div class='student-rating'><div class='student-rating-number'>"+data.overall+"</div></div></div><div class='right-panel'><div class='diff-date'><div class='difficulty'>Difficulty: "+data.difficulty+"</div><div class='date'>"+data.date+"</div></div><div class='student-comment'>"+data.body+"</div></div></div>"; 
//         $('#main-container').append(html);
// }

// $(document).ready(function(){

//     var comment = [];

//     if(!localStorage.commentData){
//         localStorage.commentData = [];
//     }else{
//         comment = JSON.parse(localStorage.commentData);
//     }
    
//     for(var i = 0; i < comment.length; i++){
//         render(comment[i]);
//     }

//     $('#addComment').click(function(){
//         var addObj = {
//             'overall': $('input[name="scale1"]:checked').val(),
//             'difficulty': $('input[name="scale2"]:checked').val(),
//             'date': $('#date').val(),
//             'body': $('#body').val(), 
//         };
//         comment.push(addObj);
//         localStorage.commentData = JSON.stringify(comment);
//         render(addObj);

//         $('#date').val('dd/mm/yyyy');
//         $('#body').val('');
//     });
// });

