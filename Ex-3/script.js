// =========================
// QUIZ QUESTIONS (1–20)
// =========================

const questions = [

{
question:"What does HTML stand for?",
answers:[
{text:"Hyper Text Markup Language",correct:true},
{text:"High Text Machine Language",correct:false},
{text:"Hyper Transfer Machine Language",correct:false},
{text:"Home Tool Markup Language",correct:false}
]
},

{
question:"Which HTML tag is used to create a hyperlink?",
answers:[
{text:"<a>",correct:true},
{text:"<link>",correct:false},
{text:"<href>",correct:false},
{text:"<url>",correct:false}
]
},

{
question:"Which HTML tag inserts an image?",
answers:[
{text:"<img>",correct:true},
{text:"<image>",correct:false},
{text:"<picture>",correct:false},
{text:"<src>",correct:false}
]
},

{
question:"Which CSS property changes text color?",
answers:[
{text:"color",correct:true},
{text:"font-color",correct:false},
{text:"text-color",correct:false},
{text:"background",correct:false}
]
},

{
question:"Which CSS property changes the background color?",
answers:[
{text:"background-color",correct:true},
{text:"bgcolor",correct:false},
{text:"color",correct:false},
{text:"background-image",correct:false}
]
},

{
question:"Which symbol is used for ID selectors in CSS?",
answers:[
{text:"#",correct:true},
{text:".",correct:false},
{text:"*",correct:false},
{text:"$",correct:false}
]
},

{
question:"Which keyword declares a variable in JavaScript?",
answers:[
{text:"var",correct:true},
{text:"integer",correct:false},
{text:"string",correct:false},
{text:"define",correct:false}
]
},

{
question:"Which method displays a popup message?",
answers:[
{text:"alert()",correct:true},
{text:"popup()",correct:false},
{text:"display()",correct:false},
{text:"message()",correct:false}
]
},

{
question:"Which operator is used for addition?",
answers:[
{text:"+",correct:true},
{text:"*",correct:false},
{text:"/",correct:false},
{text:"%",correct:false}
]
},

{
question:"Which extension is used for JavaScript files?",
answers:[
{text:".js",correct:true},
{text:".java",correct:false},
{text:".html",correct:false},
{text:".css",correct:false}
]
},

{
question:"Which HTML tag is used to define an unordered list?",
answers:[
{text:"<ul>",correct:true},
{text:"<ol>",correct:false},
{text:"<li>",correct:false},
{text:"<list>",correct:false}
]
},

{
question:"Which CSS property is used to change the font size?",
answers:[
{text:"font-size",correct:true},
{text:"text-size",correct:false},
{text:"size",correct:false},
{text:"font-style",correct:false}
]
},

{
question:"Which HTML attribute specifies an alternate text for an image?",
answers:[
{text:"alt",correct:true},
{text:"title",correct:false},
{text:"src",correct:false},
{text:"longdesc",correct:false}
]
},

{
question:"How do you write a comment in JavaScript?",
answers:[
{text:"// comment",correct:true},
{text:"<!-- comment -->",correct:false},
{text:"# comment",correct:false},
{text:"** comment **",correct:false}
]
},

{
question:"Which company developed JavaScript?",
answers:[
{text:"Netscape",correct:true},
{text:"Microsoft",correct:false},
{text:"Sun Microsystems",correct:false},
{text:"Google",correct:false}
]
},

{
question:"Which CSS property is used to control the spacing outside an element's border?",
answers:[
{text:"margin",correct:true},
{text:"padding",correct:false},
{text:"spacing",correct:false},
{text:"border-spacing",correct:false}
]
},

{
question:"Inside which HTML element do we put JavaScript?",
answers:[
{text:"<script>",correct:true},
{text:"<js>",correct:false},
{text:"<javascript>",correct:false},
{text:"<code>",correct:false}
]
},

{
question:"Which function is used to convert a string into an integer in JavaScript?",
answers:[
{text:"parseInt()",correct:true},
{text:"parseFloat()",correct:false},
{text:"toInteger()",correct:false},
{text:"Integer.parse()",correct:false}
]
},

{
question:"Which CSS property is used to make text bold?",
answers:[
{text:"font-weight",correct:true},
{text:"text-style",correct:false},
{text:"font-bold",correct:false},
{text:"text-weight",correct:false}
]
},

{
question:"Which method is used to write into the browser console in JavaScript?",
answers:[
{text:"console.log()",correct:true},
{text:"console.write()",correct:false},
{text:"print()",correct:false},
{text:"log.console()",correct:false}
]
}

];

// =========================
// VARIABLES
// =========================

const questionElement = document.getElementById("question");
const answerButtons = document.getElementById("answer-buttons");

const nextButton = document.getElementById("next-btn");
const prevButton = document.getElementById("prev-btn");

const progress = document.getElementById("progress");
const questionNumber = document.getElementById("question-number");
const timerElement = document.getElementById("timer");

const quizContainer = document.querySelector(".quiz-container");
const resultCard = document.getElementById("result-card");
const finalScoreElement = document.getElementById("final-score");
const percentageElement = document.getElementById("percentage");
const remarkElement = document.getElementById("remark");

let currentQuestion = 0;

let selectedAnswers = new Array(questions.length).fill(null);

// =========================
// TIMER (10 minutes total)
// =========================

const TOTAL_TIME = 10 * 60; // 10:00 in seconds
let timeLeft = TOTAL_TIME;
let timerInterval = null;

function startTimer(){

timerInterval = setInterval(()=>{

timeLeft--;

const minutes = Math.floor(timeLeft/60);
const seconds = timeLeft%60;

timerElement.innerHTML =
`${minutes}:${seconds<10 ? "0"+seconds : seconds}`;

if(timeLeft<=0){

clearInterval(timerInterval);

finishQuiz();

}

},1000);

}

// =========================
// START QUIZ
// =========================

showQuestion();
startTimer();

// =========================
// DISPLAY QUESTION
// =========================

function showQuestion(){

resetState();

let current = questions[currentQuestion];

questionNumber.innerHTML =
`Question ${currentQuestion+1} / ${questions.length}`;

progress.style.width =
((currentQuestion+1)/questions.length)*100 + "%";

questionElement.textContent = current.question;

current.answers.forEach((answer,index)=>{

const button = document.createElement("button");

button.textContent = answer.text;

button.classList.add("btn");

if(selectedAnswers[currentQuestion]===index){

button.classList.add("selected");

}

button.addEventListener("click",()=>selectAnswer(index));

answerButtons.appendChild(button);

});

prevButton.style.display =
currentQuestion===0 ? "none":"inline-block";

if(currentQuestion===questions.length-1){

nextButton.innerHTML="Finish";

}else{

nextButton.innerHTML="Next ➜";

}

}

// =========================
// RESET ANSWERS
// =========================

function resetState(){

answerButtons.innerHTML="";

}

// =========================
// SELECT ANSWER
// =========================

function selectAnswer(index){

selectedAnswers[currentQuestion]=index;

showQuestion();

}

// =========================
// NEXT BUTTON
// =========================

nextButton.addEventListener("click",()=>{

if(currentQuestion<questions.length-1){

currentQuestion++;

showQuestion();

}else{

finishQuiz();

}

});

// =========================
// PREVIOUS BUTTON
// =========================

prevButton.addEventListener("click",()=>{

if(currentQuestion>0){

currentQuestion--;

showQuestion();

}

});

// =========================
// FINISH QUIZ / SCORING
// =========================

function finishQuiz(){

clearInterval(timerInterval);

let score = 0;

questions.forEach((question,index)=>{

const correctIndex = question.answers.findIndex(a=>a.correct);

if(selectedAnswers[index]===correctIndex){

score++;

}

});

const percentage = Math.round((score/questions.length)*100);

let remark = "";

if(percentage>=90){
remark = "Excellent! 🌟";
}else if(percentage>=75){
remark = "Great job! 👍";
}else if(percentage>=50){
remark = "Good effort, keep practicing!";
}else{
remark = "Needs improvement — try again!";
}

finalScoreElement.innerHTML = `${score} / ${questions.length}`;

percentageElement.innerHTML = `${percentage}%`;

remarkElement.innerHTML = remark;

quizContainer.classList.add("hidden");

resultCard.classList.remove("hidden");

}