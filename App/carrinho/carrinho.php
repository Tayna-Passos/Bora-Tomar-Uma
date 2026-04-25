<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Carrinho - Bora Tomar Uma?</title>
    <link rel="icon" type="image/png" href="../img/bebida-gelada.gif">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{
            --bg:#0b0b0b;
            --card:#121212;
            --muted:#bfc7cc;
            --accent:#ff6b35;
            --accent-dark:#e0551a;
            --glass: rgba(255,255,255,0.02);
            --radius:14px;
            --max-width:1100px;
        }
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;background:linear-gradient(180deg,#070708 0%, #0c0c0c 100%);color:#eef2f5;font-family:Inter,system-ui,Arial;}
        header{padding:18px 28px;display:flex;align-items:center;gap:18px}
        .logo{font-size:26px;font-weight:800;color:var(--accent)}
        
        .delivery-notice-container {
            max-width: var(--max-width);
            margin: 10px auto 18px;
            padding: 0 22px;
        }
        .delivery-notice {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: var(--radius);
            background-color: var(--accent-dark);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }
        
        .app{max-width:var(--max-width);margin:18px auto;padding:22px;display:grid;grid-template-columns:1fr 420px;gap:22px}
        .panel{background:linear-gradient(180deg,var(--card), #0f0f0f);padding:18px;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,0.6)}
        .panel h2{margin:0 0 12px 0}
        .cart-items{display:flex;flex-direction:column;gap:12px;max-height:420px;overflow:auto;padding-right:6px}
        .cart-item{display:flex;gap:12px;align-items:center;padding:12px;border-radius:12px;background:linear-gradient(180deg,rgba(255,255,255,0.01),rgba(255,255,255,0.02));border-left:6px solid rgba(255,107,53,0.06)}
        .ci-thumb{width:72px;height:84px;border-radius:8px;overflow:hidden;flex:0 0 72px}
        .ci-thumb img{width:100%;height:100%;object-fit:cover}
        .ci-main{flex:1}
        .ci-main .name{font-weight:700}
        .ci-meta{color:var(--muted);font-size:13px}
        .qty-control{display:flex;gap:8px;align-items:center;margin-top:8px}
        .qty-btn{background:transparent;border:1px solid rgba(255,255,255,0.03);color:var(--muted);padding:6px 10px;border-radius:8px;cursor:pointer}
        .remove-btn{background:transparent;border:0;color:#ff7b7b;cursor:pointer}
        .checkout-panel{display:flex;flex-direction:column;gap:12px}
        .summary{padding:18px;border-radius:12px;background:linear-gradient(180deg,rgba(255,255,255,0.01),rgba(255,255,255,0.02))}
        .summary .row{display:flex;justify-content:space-between;align-items:center;padding:6px 0}
        .summary .total{font-weight:900;font-size:20px;color:var(--accent)}
        .payments{margin-top:8px}
        .payment-option{display:flex;align-items:center;gap:10px;padding:12px;border-radius:10px;background:linear-gradient(180deg,#0f0f0f,#101010);border:1px solid rgba(255,255,255,0.02);cursor:pointer;margin-bottom:10px}
        .payment-fields{display:none;padding:14px;border-radius:10px;background:linear-gradient(180deg,#0b0b0b,#101010);border:1px solid rgba(255,255,255,0.02)}
        .field{display:block;margin-bottom:10px}
        .field input, .delivery-fields textarea{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:#0b0b0b;color:#fff}
        .panel-section {padding: 14px;border-radius: 12px;background: linear-gradient(180deg,rgba(255,255,255,0.01),rgba(255,255,255,0.02));}
        .btn-primary{display:inline-block;background:var(--accent);color:#081223;padding:12px 16px;border-radius:10px;border:0;cursor:pointer;font-weight:700}
        .btn-ghost{background:transparent;border:1px solid rgba(255,255,255,0.03);color:var(--muted);padding:10px;border-radius:8px;cursor:pointer}
        .btn-secondary {background: var(--accent);color: #081223;font-weight: 700;border: 0;}
        .pix-row{display:flex;gap:10px;align-items:center}
        .pix-code{flex:1;padding:10px;border-radius:8px;background:#0b0b0b;border:1px solid rgba(255,255,255,0.03);color:#fff}
        .pix-copy{padding:10px 14px;border-radius:8px;background:#0077ff;border:0;color:#fff;cursor:pointer}
        .pix-msg{color:#5eead4;margin-left:8px;display:none}
        .qr-wrap img{width:160px;height:160px;border-radius:8px}
        .modal{position:fixed;left:0;top:0;width:100%;height:100%;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.6);z-index:1000}
        .modal.active{display:flex}
        .modal-card{background:var(--card);padding:20px;border-radius:12px;width:380px}
        .modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:16px}
        .botao-seta {background-color: #ff6b35;color: white;padding: 15px;border: none;border-radius: 50px;font-weight: bold;cursor: pointer;transition: all 0.3s ease;display: inline-flex;align-items: center;gap: 10px;margin-left: 100px;}
        @media (max-width:980px){.app{grid-template-columns:1fr;}.botao-seta{margin-left: 22px;width: calc(100% - 44px);justify-content: center;}}

        /* Estiliza os campos de input do cartão e outros */
.payment-fields input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1); /* Borda levemente visível */
    background: #0b0b0b; /* Fundo escuro igual ao restante */
    color: #fff; /* Texto branco */
    outline: none;
    transition: border-color 0.3s ease;
}

/* Efeito ao clicar no campo (foco) */
.payment-fields input:focus {
    border-color: var(--accent); /* Cor laranja ao selecionar */
    box-shadow: 0 0 5px rgba(255, 107, 53, 0.2);
}

/* Ajuste específico para os campos que ficam lado a lado (MM/AA e CVV) */
#cred-fields div[style*="display:flex"], 
#deb-fields div[style*="display:flex"] {
    gap: 12px !important; /* Espaçamento entre os campos pequenos */
}
.qr-wrap {
    min-height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 15px;
    background: rgba(255,255,255,0.03); /* Fundo sutil enquanto carrega */
    border-radius: 8px;
}

#qrImg {
    width: 160px;
    height: 160px;
    display: block;
}
    </style>
</head>
<body>
    
    <header>
        <div class="logo">🍻 Bora Tomar Uma?</div>
    </header>

    <div class="delivery-notice-container">
        <div class="delivery-notice">
            <i class="fa-solid fa-motorcycle"></i> 
            <span>Entrega Rápida por Delivery disponível em sua região!</span>
        </div>
    </div>

    <a href="../index.html" class="link-botao">
        <button class="botao-seta"><span>&#11013;</span> Voltar</button>
    </a>

    <div class="app">
        <section class="panel">
            <h2>Itens no Carrinho</h2>
            <div class="cart-items" id="cartItems"></div>
        </section>

        <aside class="checkout-panel panel">
            <div class="summary">
                <div class="row"><div>Subtotal</div><div id="subtotal">R$ 0,00</div></div>
                <div class="row"><div class="total">Total</div><div class="total" id="total">R$ 0,00</div></div>
                <div style="margin-top:12px;display:flex;gap:10px">
                    <button class="btn-primary" id="finishBtn">Finalizar Compra</button>
                    <button class="btn-ghost btn-secondary" id="clearBtn">Limpar</button>
                </div>
            </div>
            
            <div class="delivery-fields panel-section">
                <h3 style="margin-bottom:8px">🛵 Contratar Delivery</h3>
                <div class="field"><input id="delivery-address" placeholder="Endereço Completo (Rua, Número, Bairro)"></div>
                <div class="field"><textarea id="delivery-notes" placeholder="Observações para o Motoboy"></textarea></div>
                <div class="field"><label style="font-size:13px;color:var(--muted)">Gorjeta para o Motoboy (opcional)</label><input id="motoboy-tip" type="text" placeholder="R$ 0,00"></div>
            </div>

            <div class="payments">
                <h3 style="margin-bottom:8px">Formas de Pagamento</h3>

                <label class="payment-option" id="opt-pix"><input type="radio" name="payment" value="pix"> <strong>PIX</strong></label>
                <div id="pix-fields" class="payment-fields">
                    <label style="font-size:13px;color:var(--muted)">Código copia e cola PIX</label>
                    <div class="pix-row">
                        <input id="pixCode" class="pix-code" readonly value="...">
                        <button class="pix-copy" id="copyPixBtn">Copiar</button>
                    </div>
                    <div class="pix-msg" id="pixMsg">✔ Código PIX copiado!</div>
                    <div class="qr-wrap" id="qrWrap"><img id="qrImg" src="" alt="QR PIX" /></div>
                </div>

                <label class="payment-option" id="opt-cred"><input type="radio" name="payment" value="credito"> <strong>Cartão de Crédito</strong></label>
                <div id="cred-fields" class="payment-fields">
                    <div class="field"><input id="cc-number" placeholder="0000 0000 0000 0000" maxlength="19"></div>
                    <div class="field"><input id="cc-name" placeholder="Nome impresso no cartão"></div>
                    <div style="display:flex;gap:8px"><input id="cc-exp" placeholder="MM/AA" maxlength="5"><input id="cc-cvv" placeholder="CVV" maxlength="4"></div>
                </div>

                <label class="payment-option" id="opt-deb"><input type="radio" name="payment" value="debito"> <strong>Cartão de Débito</strong></label>
                <div id="deb-fields" class="payment-fields">
                    <div class="field"><input id="dc-number" placeholder="0000 0000 0000 0000" maxlength="19"></div>
                    <div class="field"><input id="dc-name" placeholder="Nome impresso no cartão"></div>
                    <div class="field"><input id="dc-exp" placeholder="MM/AA" maxlength="5"></div>
                </div>
                
                <label class="payment-option" id="opt-cash"><input type="radio" name="payment" value="dinheiro"> <strong>Dinheiro</strong></label>
                <div id="cash-fields" class="payment-fields">
                    <div class="field"><label style="font-size:13px;color:var(--muted)">Precisa de troco para quanto?</label><input id="cash-change" type="text" placeholder="Ex: R$ 50,00"></div>
                </div>
            </div>
        </aside>
    </div>

    <div class="modal" id="confirmModal">
        <div class="modal-card">
            <h3>Confirmar pagamento</h3>
            <p id="confirmText">Você está prestes a pagar <strong id="confirmAmount">R$ 0,00</strong>.</p>
            <div class="modal-actions">
                <button class="btn-ghost" id="modalCancel">Cancelar</button>
                <button class="btn-primary" id="modalOk">Confirmar</button>
            </div>
        </div>
    </div>

<script>
let cart = JSON.parse(localStorage.getItem('userCart')) || {};

function money(v){ return 'R$ ' + v.toFixed(2).replace('.', ','); }
function saveCart(){ localStorage.setItem('userCart', JSON.stringify(cart)); }
function updateBadge(){ const b = document.getElementById('cart-count'); if(b) b.innerText = Object.values(cart).reduce((s,i)=>s+i.qty,0); }

function getMoneyValue(id) {
    const el = document.getElementById(id);
    if (!el) return 0;
    const value = el.value.replace('R$', '').replace(/\./g, '').replace(',', '.').trim();
    return parseFloat(value) || 0;
}

function renderCart(){
    const el = document.getElementById('cartItems'); 
    el.innerHTML = '';
    let subtotal = 0;
    const keys = Object.keys(cart);

    if(keys.length === 0){
        el.innerHTML = '<div style="color:var(--muted)">Seu carrinho está vazio.</div>';
        document.getElementById('subtotal').innerText = 'R$ 0,00';
        document.getElementById('total').innerText = 'R$ 0,00';
        return;
    }

    keys.forEach(k => {
        const it = cart[k];
        subtotal += it.price * it.qty;
        let cleanImgPath = it.img.replace('../', ''); 
        const imgPath = "../" + cleanImgPath;

        const div = document.createElement('div'); 
        div.className = 'cart-item';
        div.innerHTML = `<div class="ci-thumb"><img src="${imgPath}"/></div><div class="ci-main"><div class="name">${it.name}</div><div class="ci-meta">${it.qty} × ${money(it.price)}</div><div class="qty-control"><button class="qty-btn" onclick="changeQty('${k}', -1)">−</button><div style="min-width:28px;text-align:center">${it.qty}</div><button class="qty-btn" onclick="changeQty('${k}', 1)">+</button><button class="remove-btn" onclick="removeItem('${k}')">Remover</button></div></div>`;
        el.appendChild(div);
    });

    const tipAmount = getMoneyValue('motoboy-tip');
    const total = subtotal + tipAmount;
    document.getElementById('subtotal').innerText = money(subtotal);
    let tipRow = document.getElementById('tipRow');
    if (!tipRow) {
        tipRow = document.createElement('div'); tipRow.className = 'row'; tipRow.id = 'tipRow';
        tipRow.innerHTML = `<div>Gorjeta</div><div id="tipAmount">${money(tipAmount)}</div>`;
        document.querySelector('.summary .total').parentNode.before(tipRow);
    } else {
        document.getElementById('tipAmount').innerText = money(tipAmount);
        tipRow.style.display = tipAmount > 0 ? 'flex' : 'none';
    }
    document.getElementById('total').innerText = money(total);
}

function changeQty(id,delta){ if(!cart[id]) return; cart[id].qty += delta; if(cart[id].qty<=0) delete cart[id]; saveCart(); renderCart(); updateBadge(); }
function removeItem(id){ delete cart[id]; saveCart(); renderCart(); updateBadge(); }

// Máscaras de Cartão
document.querySelectorAll('#cc-number, #dc-number').forEach(input => {
    input.addEventListener('input', (e) => {
        let v = e.target.value.replace(/\D/g, '').replace(/(\d{4})(?=\d)/g, '$1 ');
        e.target.value = v;
    });
});
document.querySelectorAll('#cc-exp, #dc-exp').forEach(input => {
    input.addEventListener('input', (e) => {
        let v = e.target.value.replace(/\D/g, '');
        if (v.length >= 2) v = v.substring(0,2) + '/' + v.substring(2,4);
        e.target.value = v;
    });
});

function maskMoney(el) {
    if (!el) return;
    el.addEventListener('input', (e) => {
        let v = e.target.value.replace(/\D/g, '');
        if (v.length === 0) { e.target.value = ''; if (e.target.id === 'motoboy-tip') renderCart(); return; }
        v = v.padStart(3, '0');
        let integerPart = v.slice(0, -2).replace(/^0+/, '') || '0';
        let decimalPart = v.slice(-2);
        e.target.value = 'R$ ' + integerPart.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ',' + decimalPart;
        if (e.target.id === 'motoboy-tip') renderCart();
    });
}
maskMoney(document.getElementById('motoboy-tip'));
maskMoney(document.getElementById('cash-change'));

const confirmModal = document.getElementById('confirmModal');
const finishBtn = document.getElementById('finishBtn');

// Função de validação de cartões
function validarCartao(tipo) {
    const prefixo = tipo === 'credito' ? 'cc' : 'dc';
    const numero = document.getElementById(`${prefixo}-number`).value.trim();
    const nome = document.getElementById(`${prefixo}-name`).value.trim();
    const exp = document.getElementById(`${prefixo}-exp`).value.trim();
    const cvv = tipo === 'credito' ? document.getElementById('cc-cvv').value.trim() : "OK";
    
    if(!numero || !nome || !exp || !cvv) {
        alert(`Por favor, preencha todos os dados do cartão de ${tipo}!`);
        return false;
    }
    return true;
}

finishBtn.addEventListener('click', ()=>{
    if(Object.keys(cart).length===0){ alert('Seu carrinho está vazio!'); return; }
    
    const method = document.querySelector('input[name="payment"]:checked');
    if(!method){ alert('Escolha uma forma de pagamento'); return; }
    
    const endereco = document.getElementById('delivery-address').value.trim();
    if(!endereco){ alert('Por favor, informe o endereço de entrega!'); return; }

    if(method.value === 'credito' || method.value === 'debito') {
        if(!validarCartao(method.value)) return;
    }

    document.getElementById('confirmAmount').innerText = document.getElementById('total').innerText;
    confirmModal.classList.add('active');
});

document.getElementById('modalCancel').addEventListener('click', ()=>{ confirmModal.classList.remove('active'); });
document.getElementById('modalOk').addEventListener('click', async () => {
    // 1. Fecha o modal
    confirmModal.classList.remove('active');

    // 2. Captura o método de pagamento selecionado
    const metodoInput = document.querySelector('input[name="payment"]:checked');
    const metodo = metodoInput ? metodoInput.value : '';

    // 3. Prepara o objeto de dados
    const dadosPedido = {
        carrinho: Object.values(cart),
        endereco: document.getElementById('delivery-address').value,
        observacoes: document.getElementById('delivery-notes').value,
        gorjeta: document.getElementById('motoboy-tip').value || "0", // Ex: "R$ 5,00"
        pagamento: metodo,
        total: document.getElementById('total').innerText, // Ex: "R$ 50,00"
        // Captura o valor do troco apenas se for dinheiro
        troco_para: metodo === 'dinheiro' ? document.getElementById('cash-change').value : null
    };

    console.log("Enviando dados:", dadosPedido); // Use o F12 no navegador para ver se isso aparece

    try {
        const resposta = await fetch('salvar_pedido.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dadosPedido)
        });

        // Verifica se a resposta do servidor é válida
        if (!resposta.ok) {
            const erroTexto = await resposta.text();
            throw new Exception("Erro no servidor: " + erroTexto);
        }

        const resultado = await resposta.json();

       if (resultado.sucesso) {
            alert('✅ ' + resultado.mensagem);
            
            // 1. Limpa o carrinho local
            cart = {};
            saveCart();
            
            // 2. Limpa os campos de texto
            document.getElementById('delivery-address').value = '';
            document.getElementById('cash-change').value = '';
            
            // 3. REDIRECIONA para a index após o usuário clicar em OK no alert
            window.location.href = "../index.html?sucesso=1";
        } else {
            alert('❌ Erro: ' + resultado.erro);
        }
    } catch (error) {
        console.error('Erro detalhado:', error);
        alert('Houve um erro ao conectar com o servidor. Verifique o console (F12).');
    }
});
function mostrarCampos(id){ 
    document.querySelectorAll('.payment-fields').forEach(d=>d.style.display='none');
    document.getElementById(id).style.display='block'; 
    if(id === 'pix-fields') generateQR();
}
document.getElementById('opt-pix').addEventListener('click', () => {
    mostrarCampos('pix-fields');
    generateQR(); // Adicione isso aqui para garantir que gere ao clicar
});

function generateQR(){
    // Pega o texto do total, remove "R$", pontos de milhar e troca vírgula por ponto
    const totalTexto = document.getElementById('total').innerText;
    const totalLimpo = totalTexto.replace('R$ ', '').replace(/\./g, '').replace(',', '.');
    
    const payload = `00020126580014BR.GOV.BCB.PIX0108BORATOMA520400005303986540${totalLimpo}5802BR5920BORATOMA43274000000000`;
    
    const qrImg = document.getElementById('qrImg');
    qrImg.src = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + encodeURIComponent(payload);
}

document.getElementById('copyPixBtn').addEventListener('click', ()=>{
    navigator.clipboard.writeText(document.getElementById('pixCode').value).then(()=>{
        document.getElementById('pixMsg').style.display='inline-block';
        setTimeout(()=>document.getElementById('pixMsg').style.display='none',2000);
    });
});
// Função para o botão Limpar
document.getElementById('clearBtn').addEventListener('click', () => {
    if (confirm('Tem certeza que deseja esvaziar todo o carrinho?')) {
        cart = {}; // Esvazia o objeto do carrinho
        saveCart(); // Atualiza o localStorage
        renderCart(); // Recarrega a interface visual
        updateBadge(); // Atualiza o contador (se houver)
        alert('Carrinho limpo com sucesso!');
    }
});

document.getElementById('opt-pix').addEventListener('click', ()=>mostrarCampos('pix-fields'));
document.getElementById('opt-cred').addEventListener('click', ()=>mostrarCampos('cred-fields'));
document.getElementById('opt-deb').addEventListener('click', ()=>mostrarCampos('deb-fields'));
document.getElementById('opt-cash').addEventListener('click', ()=>mostrarCampos('cash-fields'));

renderCart(); updateBadge();
</script>
</body>
</html>