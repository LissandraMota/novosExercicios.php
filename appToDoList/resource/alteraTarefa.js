    //fetch -> requisição retorna uma promise com uma resposta, essa response 
    //também é uma promessa (tem que resolver essa promessa usando o then)

function alterarTarefa(idTarefa, checkbox){
     const form = new FormData() //formdata é como se fosse um formulário

     if(checkbox.checked){
          form.append("status", 'on')    
     }

     form.append("id", idTarefa) //id da tarefa sempre passa

     //url da requisição
     fetch('http://localhost:8585/alteraTarefa.php', {
          method: 'POST',
          body: form  // vai receber no body o objedo da requisição que vem pelo form
      }
      ).then(function(response) {
          response.json().then(function(json) {            
              document.getElementById('status-'+json.id).textContent = json.legenda
          })
      }).catch(function(error) {
          console.error(error)
      }) 
  }
  