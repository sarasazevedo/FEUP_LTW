function encodeForAjax(data) {
        return Object.keys(data).map(function(k) {
          return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
        }).join('&');
      }
      
function drawAddQuestionjs() {
        const addButton = document.getElementById('add_button');
        const formsDiv = document.createElement('div');
        formsDiv.classList.add('ticket_form');
        formsDiv.style.display = 'none';
        const form = document.createElement('form');
        const labelQuestion = document.createElement('label');
        labelQuestion.setAttribute('for', 'question');
        labelQuestion.innerText = 'Question: ';
        const questionInput = document.createElement('input');
        const answerInput = document.createElement('input');
        questionInput.setAttribute('type', 'text');
        const labelAnswer = document.createElement('label');
        labelAnswer.setAttribute('for', 'answer');
        labelAnswer.innerText = 'Answer: ';
        answerInput.setAttribute('type', 'text');
        const submitButton = document.createElement('button');
        submitButton.setAttribute('type', 'submit');
        submitButton.innerText = 'Add FAQ';
        form.append(labelQuestion, questionInput, labelAnswer, answerInput, submitButton);
        formsDiv.append(form);

        addButton.onclick = function () {
                formsDiv.style.display = 'block';
        };

        form.onsubmit = function (event) {
                event.preventDefault();
                const question = questionInput.value;
                const answer = answerInput.value;
                const request = new XMLHttpRequest();
                request.open('POST', '../actions/action_add_question.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send(encodeForAjax({ question, answer }));
                request.onload = function () {
                form.reset();
                formsDiv.style.display = 'none';
                window.location.href = '/../pages/faq.php';
        };
        };
        document.body.append(formsDiv);
}