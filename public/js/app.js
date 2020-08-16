class App {
    timing = 1000
    delay = ms => {
        return new Promise(r => setTimeout( ()=> r(), ms))
    }
    async getData(method,object,todo = function(object) {})
    {
        let quest = {'method':method,'data':object}
        try
        {
            await this.delay(this.timing)
            const response = await fetch ('/',{
                method: 'POST',
                headers: {
                    'Content-Type':'application/json; charset=utf-8'
                },
                body: JSON.stringify(quest)
            })

            const data = await response.json()

            todo(data.ans)
        }
        catch (e)
        {
            console.log(e) || todo('Ошибка запроса')
        }
    }
}

$App = new App();

let spin = document.querySelector('.spin')

loginForm.addEventListener('submit',(e)=>{
    e.preventDefault()
    loginForm.classList.remove('active')
    spin.classList.add('active')
    let object = {}
    switch (loginForm.dataset.method) {
        case 'login':
            object =
            {
                name: exampleInputEmail1.value,
                pass : exampleInputPassword1.value
            }
            break;
        case 'newTask':
            object =
            {
                name: exampleInputEmail1.value,
                longtext: exampleFormControlTextarea1.value,
                email: exampleFormControlInput1.value
            }
            break;
        case 'rewrite':
            object =
            {
                pagg: loginForm.dataset.pagg,
                name: exampleInputEmail1.value,
                longtext: exampleFormControlTextarea1.value,
                email: exampleFormControlInput1.value
            }
            break;
        default:
            break;
    }
    $App.getData(loginForm.dataset.method,object,(ans)=>{
        console.log(ans)
        if (ans.status === 1)
        {
            window.location = '/'
        }
        else
        {
            loginForm.querySelectorAll('input').forEach(el=>{
                el.classList.add('err')
            })
            spin.classList.remove('active')
            loginForm.classList.add('active')
            emailHelp.innerHTML = ans.error
            emailHelp.classList.add('active')
        }
    })
})

document.querySelectorAll('button').forEach(button=>{
    if (button.dataset.id)
    {
        button.addEventListener('click',(e)=>{
            e.preventDefault()
            button.classList.add('none')
            object = {
                id: button.dataset.id
            }
            $App.getData('isdo',object,(ans)=>{
                if (ans.status === 1)
                {
                    button.parentElement.querySelector('.btn-warning').classList.add('none')
                    let ISdo = document.createElement('div')
                    ISdo.classList.add('btn')
                    ISdo.classList.add('btn-success')
                    ISdo.innerHTML = 'Выполнено'
                    button.parentElement.append(ISdo)
                }
                else
                {
                    button.classList.remove('none')
                }
            })
        })
    }
})

loginForm.querySelectorAll('input').forEach(el=>{
    el.addEventListener('input',()=>{
        el.classList.remove('err')
    })
    el.addEventListener('change',()=>{
        emailHelp.innerHTML = ""
        switch (el.type)
        {
            case 'email':
                if (el.value.length < 6) {
                    el.classList.add('err')
                    emailHelp.innerHTML = 'Email не валиден'
                }
                break;
            case 'password':
                if (el.value.length < 2) { el.classList.add('err') }
                break;
        }
    })
})
