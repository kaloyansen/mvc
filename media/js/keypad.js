'use strict';
/**
 *
 * @author Eric PONCHANT
 * @link eric.ponchant@elearningweb.onmicrosoft.com
 * @description login with a virtual keyboard
 * @version 0.0.1
 *
 */
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
        //return this;
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
                    currentDiv.classList.add('lien');
                    str += '-' + num + '-';
                    test = false;
                }
            }
            test = true;
        }
        //return this;
    }

    resetKeystroke() {
        let element = this.currentDiv;
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
        this.setKeystroke();
        this.setKeystrokeText();
        this.eventKeystroke();
    }

    eventKeystroke() {
        const CASE = document.getElementsByClassName('case');
        const pw = document.getElementById('password');
        var datakey;
        for (const cas of CASE) {

            cas.addEventListener('click', function() {

                datakey = this.getAttribute('data-key');
                if (datakey < 0) datakey = '';
                else pw.value = pw.value + datakey;
                window.console.log(pw.value);
            }, false);
        }
    }
}

class Connexion {

    constructor(form, login, password, result, reset) {

        this.FORM = document.getElementById(form);
        this.LOGIN = document.getElementById(login);
        this.PASSWORD = document.getElementById(password);
        this.RESULT = document.getElementById(result);
        this.RESET = document.getElementById(reset);
        //this.url = this.FORM.getAttribute('action');
    }

    submitForm() {

        let pw = this.PASSWORD;
        let id = this.LOGIN;
        if (pw) window.console.log(id.value, pw.value);
        else window.console.error('no password :(');


        this.FORM.addEventListener('submit', function() {
            window.console.log(id.value, pw.value);
            //if (!id || !pw) event.preventDefault();
        })
        //return this;
   
    }

    resetForm(ks) {

        let pw = this.PASSWORD;
        let id = this.LOGIN;
        let result = this.RESULT;

        this.RESET.addEventListener('click', function() {
            result.setAttribute('class', '');
            window.console.log(id.value, pw.value);
            result.innerText = pw.value = '';
            ks.resetKeystroke();
        }, false);
        
        id.focus();
    }
}

let keystroke = new Keystroke('pad');
keystroke.setKeystroke();
keystroke.setKeystrokeText();
keystroke.eventKeystroke();

let connexion = new Connexion('logform', 'pseudo', 'password', 'result', 'reset');
connexion.submitForm();
connexion.resetForm(keystroke);
