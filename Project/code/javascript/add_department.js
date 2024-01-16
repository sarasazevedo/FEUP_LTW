function encodeForAjax(data) {
  return Object.keys(data).map(function(k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
  }).join('&');
}
function drawAddDepartmentjs() {
  const addButton = document.getElementById('add_button');
  const formsDiv = document.createElement('div');
  formsDiv.classList.add('ticket_form');
  formsDiv.style.display = 'none';
  const form = document.createElement('form');
  const label = document.createElement('label');
  label.setAttribute('for', 'department');
  label.innerText = 'New department: ';
  const input = document.createElement('input');
  input.setAttribute('type', 'text');
  const submit = document.createElement('button');
  submit.setAttribute('type', 'submit');
  submit.innerText = 'Confirm';
  form.append(label, input, submit);
  formsDiv.append(form);

  addButton.onclick = function () {
    formsDiv.style.display = 'block';
  };

  form.onsubmit = function (event) {
    event.preventDefault();
    const department = input.value;
    const request = new XMLHttpRequest();
    request.open('POST', '../actions/action_add_department.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(encodeForAjax({department}));
    request.onload = form.reset();
    formsDiv.style.display = 'none';
  };
  document.body.append(formsDiv);
}