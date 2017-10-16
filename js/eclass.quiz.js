// JavaScript Document
$(function(){
	var progress = $('#progress'), 
    progressKeeper = $('#progressKeeper'), 
    notice = $("#notice"), 
    progressWidth = 548,  
    userAnswers = [], 
    questionsStatus = $("#questionNumber") 
    questionsList = $(".question");
	
	$(document).on("click","#btnResult",function(){
		var tempCheck = $(this).parents('.eclass-page').find('input[type=radio]:checked'); 
		if (tempCheck.length == 0) { 
			 alert("Anda tidak menjawap sebarang soalan!");
			 return false; 
		} 
		var tempArr = $('input[type=radio]:checked'); 
		for (var i = 0, ii = tempArr.length; i < ii; i++) { 
			userAnswers.push(tempArr[i].getAttribute('data-key')); 
		}
		//return false; 
		console.log(userAnswers);
	});
})