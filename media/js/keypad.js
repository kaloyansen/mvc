'use strict';

class Keystroke {

    constructor(div) {
        this.currentDiv = document.getElementById(div);
    }

    setKeystroke() {
        for (let i = 0; i < 16; i++) {
            let newDiv = document.createElement('div');
            newDiv.classList.add('case');
            newDiv.setAttribute('id', 'case' + i)
            newDiv.setAttribute('data-key', -1);
            this.currentDiv.appendChild(newDiv);
        }
        return this;
    }

    setKeystrokeText() {
        let num, test = true, str = '';
        for (let i = 0; i < 10; i++) {
            while (test == true) {
                num = Math.floor(Math.random() * 16);
                //if (str.indexOf('-' + num + '-') > -1) {
                if (str.indexOf('-' + num + '-') < 0) {
                    //num = Math.floor(Math.random() * 16);
                //} else {
                    let newSpan = document.createElement('span');
                    let newContent = document.createTextNode(i);
                    newSpan.appendChild(newContent);
                    let currentDiv = document.getElementById('case' + num);
                    currentDiv.appendChild(newSpan);
                    currentDiv.setAttribute('data-key', i);
                    str += '-' + num + '-';
                    test = false;
                }
            }
            test = true;
        }
        return this;
    }

    resetKeystroke() {
        let element = this.currentDiv;
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
        keystroke.setKeystroke().setKeystrokeText().eventKeystroke();
    }

    eventKeystroke() {
        let cases = document.getElementsByClassName('case');
        for (const cas of cases) {
            cas.addEventListener('click', function() {
                if (this.getAttribute('data-key') < 0) {
                    password.value = password.value;
                } else {
                    password.value = password.value + this.getAttribute('data-key');
                }
            }, false);
        }
    }
}

class Connexion {

    constructor(form, login, password, result, reset) {
        this.form = document.getElementById(form);
        this.login = document.getElementById(login);
        this.password = document.getElementById(password);
        this.result = document.getElementById(result);
        this.reset = document.getElementById(reset);
        this.url = this.form.getAttribute('action');
    }

    submitForm() {
        //let login = this.login, password = this.password, url = this.url, result = this.result;

        this.form.addEventListener('submit', function(event) {

            event.preventDefault();
            /*
            let formData = new FormData(this);
            formData.append('login', login.value);
            formData.append('password', password.value);

            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(res => {
                    console.log(res);
                    if (res == false) {
                        throw Error(res.status);
                    } else {
                        return res.json();
                    }
                })
                .then(res => {
                    console.log(res);
                    let parentDiv = this.parentNode;
                    if (res.check == true) {
                        result.setAttribute('class', 'col-lg-9 mx-auto alert alert-success');
                        parentDiv.parentNode.removeChild(parentDiv);
                    } else {
                        result.setAttribute('class', 'col-lg-9 mx-auto alert alert-warning');
                        password.value = '';
                    }
                    result.textContent = res.message;
                })
             */
        })
        return this;
    }

    resetForm() {
        let result = this.result, password = this.password;
        this.reset.addEventListener('click', function() {
            result.setAttribute('class', '');
            result.innerText = password.value = '';
            keystroke.resetKeystroke();
        }, false);
    }
}

let keystroke = new Keystroke('pad');
keystroke.setKeystroke().setKeystrokeText().eventKeystroke();

let connexion = new Connexion('form', 'login', 'password', 'result', 'reset');
connexion.submitForm().resetForm();