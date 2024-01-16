function encodeForAjax(data) {
    return Object.keys(data)
    .map(function (k) {
        return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
    })
    .join("&");
}

function drawListByjs() {
    const listByDiv = document.createElement("div");
    listByDiv.classList.add("listby-container");
    const label = document.createElement("label");
    label.innerText = "List by: ";
    const optionSelected = document.createElement("select");
    optionSelected.setAttribute("type", "listby");

    const options = ['recently', 'oldest', 'open', 'department'];
    for (let i = 0; i < options.length; i++) {
        const option = document.createElement("option");
        option.setAttribute("value", options[i]);
        option.innerText = options[i];
        optionSelected.appendChild(option);
    }

    const submitButton = document.createElement("button");
    submitButton.classList.add('agent_button');
    submitButton.setAttribute("type", "showOptions");
    submitButton.innerText = "Confirm";
    listByDiv.append(label, optionSelected, submitButton);
    document.body.append(listByDiv);

    submitButton.onclick = function () {
        const optionToList = optionSelected.value;
        const request = new XMLHttpRequest();
        request.open('POST', `../actions/action_listby.php?sort=${optionToList}`, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(encodeForAjax({ sort: optionToList }));
        window.location.href = '/../pages/viewtickets.php';
    };
}


  