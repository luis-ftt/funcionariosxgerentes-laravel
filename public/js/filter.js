document.addEventListener('DOMContentLoaded', () => {
  loadTasks({ preventDefault: () => {} }, '');
});

function loadTasks(event, query){

    event.preventDefault();

    fetch(`/api/Task?${query}`)
    .then(res => res.json())
    .then(data => {
        const container = document.querySelector('.grid');
        container.innerHTML = ''; 

      if (data.length === 0) {
        container.innerHTML = '<p>Nenhuma tarefa encontrada.</p>';
        return;
      }
    
      data.forEach(data => {

        const borderColor = {
            concluida: { color: 'text-green-600', label: 'Concluído' },
            andamento: { color: 'text-yellow-600', label: 'Em andamento' },
            pendente: { color: 'text-red-600', label: 'Pendente' },
        }

        borderMap = borderColor[data.status]

        const priorityColor = {
            alta: { color: 'text-red-600', label: 'ALTA' },
            media: { color: 'text-yellow-600', label: 'Normal' },
            baixa: { color: 'text-green-600', label: 'Baixa' },
        }
        
        priorityMap = priorityColor[data.priority]

        const statusColor = {
            concluida: { color: 'text-green-600', label: 'Concluído' },
            andamento: { color: 'text-yellow-600', label: 'Em andamento' },
            pendente: { color: 'text-red-600', label: 'Pendente' },
        }
        statusMap = statusColor[data.status]
        

        const card = document.createElement('div');
        card.className = `bg-white shadow rounded p-4 border-l-4 ${borderMap.color}`;

        card.innerHTML = `
          <h3 class="font-bold text-lg text-gray-900">${data.title}</h3>
          <div class="text-sm text-gray-500">Status: <span class="font-medium ${statusMap.color}">${statusMap.label}</span></div>
          <div class="text-sm text-gray-500">Prioridade: <span class="${priorityMap.color}">${priorityMap.label}</span></div>
          <div class="text-sm text-gray-500">Vencimento: ${data.due_date || 'Sem data'}</div>
          <div class="text-sm text-gray-500">Tarefa para ID: ${data.user_id || 'Sem data'}</div> <br>
          <div class="text-left text-gray-700 hover:text-lg transition-all duration-100 ease">
            <button class="status underline cursor-pointer">Alterar Status</button>
            </div>
        `
            const btnChangeStatus = card.querySelector('.status')
            btnChangeStatus.addEventListener("click", function (e) {
                if(e.target.textContent == 'Alterar Status'){
                    formatedData = {
                        concluida : {label:"Tarefa Concluída"},
                        pendente : {label:"Tarefa Pendente"},
                        andamento : {label:"Tarefa em andamento"}
                    }
                    formatedDataPriority = {
                        baixa: {label: 'Prioridade Atual: Baixa' },
                        media: {label: 'Prioridade Atual: Média' },
                        alta: {label: 'Prioridade Atual: Alta' },
                    }
                    formatedMapPriority = formatedDataPriority[data.priority]
                    formatedMap = formatedData[data.status]
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const modalStatusChange = document.createElement('div')
                    modalStatusChange.innerHTML = `
                    <div class="fixed inset-0 flex items-center justify-center bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4 sm:mx-0">
                            <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">${data.title}</h2>
                            <button class="close text-2xl text-gray-400 cursor-pointer hover:text-gray-600">&times;</button>
                            </div>
                            <div class="text-gray-700">
                            <p>${formatedMap.label}</p>
                            <p class="mt-3 mb-3">${formatedMapPriority.label}</p>
                           <form action="/editTask" method="POST">
                           <input type="hidden" id=id name=id value=${data.id}>
                           <input type="hidden" name="_token" value="${csrfToken}">
                            <select name="status" class="border rounded-md p-2">
                                <option value="" disabled selected>Trocar Status</option>
                                <option name="andamento" value="andamento">Em andamento</option>
                                <option name="pendente" value="pendente">Pendente</option>
                                <option name="concluida" value="concluida">Concluido</option>
                            </select>
                            <button type="submit" class="border rounded-sm ml-3 p-2 hover:bg-gray-100">Enviar</button>
                            </div>
                        </div>
                    </div>`
                    document.body.appendChild(modalStatusChange)
                    closeBtn = document.querySelector('.close')
                    if(closeBtn){
                        closeBtn.addEventListener('click', function (){
                            modalStatusChange.remove()
                        });
                    }
                    }
            })
        container.appendChild(card);

        if(data.status == 'andamento' || data.status == 'pendente'){
            const Button = document.createElement('button');
            Button.textContent = 'Visualizar Tarefa'
            Button.classList.add('underline', 'text-gray-700', 'hover:text-lg', 'transition-all','duration-100','ease','text-left','cursor-pointer')


            Button.addEventListener('click', function(e) {
                if(e.target.textContent == "Visualizar Tarefa"){
                    const modal = document.createElement('div')
                    modal.innerHTML = `
                    <div class="fixed inset-0 flex items-center justify-center bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4 sm:mx-0">
                            <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">${data.title}</h2>
                            <button class="close text-2xl text-gray-400 cursor-pointer hover:text-gray-600">&times;</button>
                            </div>
                            <div class="text-gray-700">
                            <p>${data.description}</p>
                            </div>
                        </div>
                    </div>`

                    document.body.appendChild(modal)
                    const closeBtn = modal.querySelector('.close');
                    if(closeBtn){
                        closeBtn.addEventListener('click', () => {
                            modal.remove()
                        })
                    }
                }
            });
            
            
            card.appendChild(Button);
        } else if (data.status == 'concluida'){
            const button = document.createElement('button');
            button.classList.add('underline', 'hover:text-lg', 'transition-all','duration-100','ease','text-left','cursor-pointer')
            button.textContent = 'Excluir Tarefa'

            button.addEventListener('click', function () {
                const confirmar = confirm("Você já terminou essa tarefa?")
                if(confirmar){
                fetch(`/delete/task?id=${data.id}`,{
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    window.location.href = data.url
                })                
                }
            });
            card.appendChild(button)


        }
        
        
      });

    });
}