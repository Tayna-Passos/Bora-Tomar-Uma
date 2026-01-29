import tkinter as tk
from tkinter import ttk, messagebox
import sqlite3


# --- 1. Funções do Banco de Dados SQLite ---

def conectar_db():
    """Cria uma conexão com o banco de dados e garante que a tabela de vendas exista."""
    # O arquivo 'vendas_doacoes.db' será criado aqui.
    conn = sqlite3.connect('vendas_doacoes.db')
    cursor = conn.cursor()

    # Tabela renomeada para 'vendas' e colunas expandidas
    cursor.execute("""
                   CREATE TABLE IF NOT EXISTS vendas
                   (
                       id
                       INTEGER
                       PRIMARY
                       KEY
                       AUTOINCREMENT,
                       nome_cliente
                       TEXT
                       NOT
                       NULL,
                       nome_bebida
                       TEXT
                       NOT
                       NULL,
                       preco_bebida
                       REAL
                       NOT
                       NULL,
                       doacao_tartaruga
                       REAL
                       NOT
                       NULL,
                       nome_tartaruga
                       TEXT
                       NOT
                       NULL
                   )
                   """)
    conn.commit()
    return conn


def inserir_venda(nome_cliente, nome_bebida, preco_bebida, doacao_tartaruga, nome_tartaruga):
    """Insere um novo registro de venda e doação no banco de dados."""
    conn = conectar_db()
    cursor = conn.cursor()
    cursor.execute(
        "INSERT INTO vendas (nome_cliente, nome_bebida, preco_bebida, doacao_tartaruga, nome_tartaruga) VALUES (?, ?, ?, ?, ?)",
        (nome_cliente, nome_bebida, preco_bebida, doacao_tartaruga, nome_tartaruga)
    )
    conn.commit()
    conn.close()

def deletar_venda(id_venda):
    """Remove um registro de venda do banco de dados pelo ID."""
    conn = conectar_db()
    cursor = conn.cursor()
    cursor.execute("DELETE FROM vendas WHERE id=?", (id_venda,))
    conn.commit()
    conn.close()

def visualizar_vendas():
    """Busca todos os registros de vendas no banco de dados."""
    conn = conectar_db()
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM vendas")
    dados = cursor.fetchall()
    conn.close()
    return dados


def limpar_tabela_interface():
    """Remove todos os itens da tabela Treeview na interface."""
    for item in tabela.get_children():
        tabela.delete(item)


def preencher_tabela():
    """
    Limpa a tabela na interface e a preenche com dados do banco.
    IMPORTANTE: O ID do banco de dados (venda[0]) é usado como iid
    (identificador interno do item) para facilitar a exclusão.
    """
    limpar_tabela_interface()
    vendas = visualizar_vendas()

    for venda in vendas:
        # Indices: [0]: id, [1]: cliente, [2]: bebida, [3]: preco, [4]: doacao, [5]: tartaruga
        tabela.insert('', 'end', iid=venda[0], values=(
            venda[1],
            venda[2],
            f"R$ {venda[3]:.2f}",
            f"R$ {venda[4]:.2f}",
            venda[5]
        ))


def adicionar_venda():
    """Função chamada ao clicar no botão Adicionar."""

    # 1. Coletar dados
    nome_cliente = entry_nome_cliente.get().strip()
    nome_bebida = entry_nome_bebida.get().strip()
    nome_tartaruga = entry_nome_tartaruga.get().strip()

    # 2. Validação de campos de texto
    if not nome_cliente or not nome_bebida or not nome_tartaruga:
        messagebox.showerror("Erro de Entrada",
                             "Por favor, preencha todos os campos de texto (Cliente, Bebida, Tartaruga).")
        return

    # 3. Validação do Preço da Bebida (monetário, positivo)
    try:
        preco_bebida_str = entry_preco_bebida.get().replace(',', '.')
        preco_bebida = float(preco_bebida_str)
        if preco_bebida <= 0:
            raise ValueError
    except ValueError:
        messagebox.showerror("Erro de Entrada", "O Preço da Bebida deve ser um valor numérico positivo.")
        return

    # 4. Validação da Doação da Tartaruga (monetário, não negativo)
    try:
        doacao_tartaruga_str = entry_doacao_tartaruga.get().replace(',', '.')
        doacao_tartaruga = float(doacao_tartaruga_str)
        if doacao_tartaruga < 0:
            raise ValueError
    except ValueError:
        messagebox.showerror("Erro de Entrada", "A Doação da Tartaruga deve ser um valor numérico positivo ou zero.")
        return

    # 5. Insere no banco e atualiza a interface
    inserir_venda(nome_cliente, nome_bebida, preco_bebida, doacao_tartaruga, nome_tartaruga)
    preencher_tabela()

    # Limpa os campos de entrada
    entry_nome_cliente.delete(0, tk.END)
    entry_nome_bebida.delete(0, tk.END)
    entry_preco_bebida.delete(0, tk.END)
    entry_doacao_tartaruga.delete(0, tk.END)
    entry_nome_tartaruga.delete(0, tk.END)


def remover_venda():
    """Pega o registro selecionado na Treeview, confirma e deleta do DB."""
    # Obtém o iid do item focado (selecionado). O iid é o ID do DB.
    item_selecionado = tabela.focus()
    if not item_selecionado:
        messagebox.showwarning("Aviso", "Por favor, selecione um registro para remover.")
        return

    try:
        # O iid foi definido como o ID do banco de dados (que é uma string)
        id_venda = int(item_selecionado)
        valores = tabela.item(item_selecionado, 'values')
        nome_cliente = valores[0]

        if messagebox.askyesno("Confirmação de Exclusão",
                               f"Tem certeza que deseja remover a venda do cliente '{nome_cliente}'?"):
            deletar_venda(id_venda)
            preencher_tabela()
            messagebox.showinfo("Sucesso", "Registro removido com sucesso!")

    except Exception as e:
        messagebox.showerror("Erro", f"Ocorreu um erro ao tentar remover o registro: {e}")


def limpar_registros():
    """Remove todos os registros da tabela 'vendas' no DB e atualiza a interface."""
    if messagebox.askyesno("Confirmação",
                           "Tem certeza que deseja limpar todos os registros de vendas e doações? Esta ação é irreversível."):
        conn = conectar_db()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM vendas")
        conn.commit()
        conn.close()
        preencher_tabela()
        messagebox.showinfo("Sucesso", "Todos os registros foram limpos com sucesso!")


# --- 2. Configuração da Interface Tkinter e Tema Oceano ---

# Inicializa a janela principal
app = tk.Tk()
app.title("Registro de Vendas e Doações (Tema Oceano)")
app.geometry("850x550")  # Janela um pouco maior para acomodar mais colunas

# --- Aplicação do Tema Oceano (Estilos Preservados) ---
style = ttk.Style(app)
style.theme_use('clam')

BG_LIGHT = '#E0FFFF'  # Azul Piscina (calm ocean surface)
BG_DARK = '#ADD8E6'  # Azul Claro (deeper ocean/frame)
FG_DARK = '#004D7A'  # Azul Marinho (text/accents)
FG_TEXT = '#333333'  # Texto escuro

app.configure(bg=BG_LIGHT)

style.configure('Ocean.TLabelframe', background=BG_LIGHT, bordercolor=FG_DARK)
style.configure('Ocean.TLabelframe.Label', background=BG_LIGHT, foreground=FG_DARK, font=('Inter', 11, 'bold'))
style.configure('Ocean.TLabel', background=BG_LIGHT, foreground=FG_TEXT, font=('Inter', 10))
style.configure('Ocean.TButton', background=FG_DARK, foreground='white', font=('Inter', 10, 'bold'), borderwidth=0,
                relief="flat")
style.map('Ocean.TButton',
          background=[('active', '#007AA3')],
          foreground=[('active', 'white')])
style.configure('Ocean.Treeview.Heading', font=('Inter', 10, 'bold'), background=FG_DARK, foreground='white')
style.configure('Ocean.Treeview', background='white', foreground='black', fieldbackground=BG_LIGHT, borderwidth=1,
                relief='solid')
style.map('Ocean.Treeview', background=[('selected', '#007AA3')])
# --- Fim do Tema Oceano ---

# Frame para os campos de entrada (Entrada de Dados)
frame_entrada = ttk.LabelFrame(app, text=" Registrar Nova Venda e Doação ", style='Ocean.TLabelframe')
frame_entrada.pack(padx=15, pady=15, fill="x")

# --- Labels e Campos de Entrada (Widgets) ---

# Campo 1: Nome do Cliente
ttk.Label(frame_entrada, text="Nome do Cliente:", style='Ocean.TLabel').grid(row=0, column=0, padx=5, pady=5,
                                                                             sticky="w")
entry_nome_cliente = ttk.Entry(frame_entrada, width=30)
entry_nome_cliente.grid(row=0, column=1, padx=5, pady=5)

# Campo 2: Nome da Bebida
ttk.Label(frame_entrada, text="Nome da Bebida:", style='Ocean.TLabel').grid(row=1, column=0, padx=5, pady=5, sticky="w")
entry_nome_bebida = ttk.Entry(frame_entrada, width=30)
entry_nome_bebida.grid(row=1, column=1, padx=5, pady=5)

# Campo 3: Preço da Bebida (Unitário/Total)
ttk.Label(frame_entrada, text="Preço da Bebida (R$):", style='Ocean.TLabel').grid(row=2, column=0, padx=5, pady=5,
                                                                                  sticky="w")
entry_preco_bebida = ttk.Entry(frame_entrada, width=30)
entry_preco_bebida.grid(row=2, column=1, padx=5, pady=5)

# Campo 4: Doação da Tartaruga
ttk.Label(frame_entrada, text="Doação da Tartaruga (R$):", style='Ocean.TLabel').grid(row=3, column=0, padx=5, pady=5,
                                                                                      sticky="w")
entry_doacao_tartaruga = ttk.Entry(frame_entrada, width=30)
entry_doacao_tartaruga.grid(row=3, column=1, padx=5, pady=5)

# Campo 5: Nome da Tartaruga
ttk.Label(frame_entrada, text="Nome da Tartaruga:", style='Ocean.TLabel').grid(row=4, column=0, padx=5, pady=5,
                                                                               sticky="w")
entry_nome_tartaruga = ttk.Entry(frame_entrada, width=30)
entry_nome_tartaruga.grid(row=4, column=1, padx=5, pady=5)

# Frame para os botões
frame_botoes = ttk.Frame(frame_entrada, style='Ocean.TLabelframe')
# Ajusta a posição do frame de botões para ficar centralizado sob os campos
frame_botoes.grid(row=5, column=0, columnspan=2, pady=10)

# Botão 1: Adicionar Venda
btn_adicionar = ttk.Button(frame_botoes, text="Registrar Venda", command=adicionar_venda, style='Ocean.TButton')
btn_adicionar.pack(side=tk.LEFT, padx=10)

# Botão 2: NOVO - Remover Selecionado
btn_remover = ttk.Button(frame_botoes, text="Remover Selecionado", command=remover_venda, style='Ocean.TButton')
btn_remover.pack(side=tk.LEFT, padx=10)

# Botão 3: Limpar Todos
btn_limpar = ttk.Button(frame_botoes, text="Limpar Todos os Registros", command=limpar_registros, style='Ocean.TButton')
btn_limpar.pack(side=tk.LEFT, padx=10)

# --- 3. Tabela (Treeview) para Exibir os Registros ---

colunas = ("Cliente", "Bebida", "Preço Bebida", "Doação Tartaruga", "Nome Tartaruga")
tabela = ttk.Treeview(app, columns=colunas, show='headings', style='Ocean.Treeview')

# Configuração dos cabeçalhos
tabela.heading("Cliente", text="Nome do Cliente")
tabela.heading("Bebida", text="Nome da Bebida")
tabela.heading("Preço Bebida", text="Preço Bebida")
tabela.heading("Doação Tartaruga", text="Doação da Tartaruga")
tabela.heading("Nome Tartaruga", text="Nome da Tartaruga")

# Configuração da largura e alinhamento das colunas
tabela.column("Cliente", width=160, anchor="w")
tabela.column("Bebida", width=160, anchor="w")
tabela.column("Preço Bebida", width=120, anchor="e")
tabela.column("Doação Tartaruga", width=140, anchor="e")
tabela.column("Nome Tartaruga", width=160, anchor="w")

# Adiciona a tabela
tabela.pack(padx=15, pady=10, fill="both", expand=True)

# Preenche a tabela com dados existentes ao iniciar
preencher_tabela()

# Inicia o loop principal da aplicação (mantém a janela aberta)
app.mainloop()