# 📋 TaskFlow - Sistema de Gerenciamento de Tarefas (Laravel)

Um sistema simples de gerenciamento de tarefas desenvolvido com Laravel, com foco no backend e na prática de conceitos como autenticação, relacionamentos, filtragem e logs de ações.

## 🚀 Funcionalidades

### 👑 Administrador
- Cadastro de tarefas para funcionários
- Definição de:
  - Urgência da tarefa (Urgente, Média, Baixa)
  - Data de entrega
  - Título e descrição
- Acesso aos **logs de ações**:
  - Visualiza o que foi criado, editado ou excluído

### 👷 Funcionário
- Visualização de tarefas recebidas
- Filtros por:
  - Urgência
  - Status (Pendente, Em andamento)
- Ao concluir uma tarefa, ela é automaticamente excluída

## 🛠 Tecnologias

- Laravel 12.x
- Blade
- MySQL (ou outro banco compatível)
- Bootstrap (ou outro framework para layout, se usado)

## ⚙️ Instalação

1. Clone este repositório:

```bash
git clone https://github.com/seu-usuario/seu-repo.git
