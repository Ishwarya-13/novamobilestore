const fallbackProducts = [
 {id:1,name:'iPhone 16 Pro',brand:'Apple',price:119900,old_price:129900,category:'Apple',description:'A18 Pro performance, an advanced camera system and a beautifully refined titanium design.',image_url:'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=900&q=85',rating:4.9,badge:'BESTSELLER',stock:12},
 {id:2,name:'Galaxy S25 Ultra',brand:'Samsung',price:129999,old_price:139999,category:'Samsung',description:'A powerful Galaxy experience with an expansive display, versatile cameras and S Pen creativity.',image_url:'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=900&q=85',rating:4.8,badge:'JUST IN',stock:8},
 {id:3,name:'Pixel 9 Pro',brand:'Google',price:99999,old_price:109999,category:'Google',description:'A clean, intelligent Android experience with thoughtful AI tools and a camera made for every moment.',image_url:'https://images.unsplash.com/photo-1598327105666-5e4a0f8b6b5a?auto=format&fit=crop&w=900&q=85',rating:4.8,badge:'STAFF PICK',stock:10},
 {id:4,name:'OnePlus 13',brand:'OnePlus',price:69999,old_price:74999,category:'OnePlus',description:'Flagship speed, immersive viewing and all-day power in a confident, considered design.',image_url:'https://images.unsplash.com/photo-1605236453806-6ff36851218e?auto=format&fit=crop&w=900&q=85',rating:4.7,badge:'GREAT VALUE',stock:14},
 {id:5,name:'iPhone 15',brand:'Apple',price:69900,old_price:79900,category:'Apple',description:'A dynamic camera, vivid display and smooth everyday performance in a familiar, durable design.',image_url:'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=900&q=85',rating:4.7,stock:9},
 {id:6,name:'Galaxy Z Flip6',brand:'Samsung',price:89999,old_price:99999,category:'Samsung',description:'A pocket-sized foldable with a flexible form, expressive cover screen and creative camera features.',image_url:'https://images.unsplash.com/photo-1610945264803-c22b62d2a7b3?auto=format&fit=crop&w=900&q=85',rating:4.6,badge:'TRENDING',stock:6},
 {id:7,name:'Pixel 8a',brand:'Google',price:52999,old_price:59999,category:'Google',description:'A smart everyday companion with helpful Google features, dependable battery life and a brilliant camera.',image_url:'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=85',rating:4.6,stock:16},
 {id:8,name:'OnePlus 12R',brand:'OnePlus',price:39999,old_price:45999,category:'OnePlus',description:'A smooth, fast phone with a bright display and performance that punches above its price.',image_url:'https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?auto=format&fit=crop&w=900&q=85',rating:4.5,badge:'VALUE PICK',stock:18}
];
let products = [], activeCategory = 'all', cart = JSON.parse(localStorage.getItem('novaCart') || '[]');
const $ = s => document.querySelector(s);
const money = n => new Intl.NumberFormat('en-IN',{style:'currency',currency:'INR',maximumFractionDigits:0}).format(Number(n));
const escapeHTML = s => String(s ?? '').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

async function loadProducts(){
  try { const r=await fetch('api/products.php'); const d=await r.json(); products=d.success && d.products.length ? d.products : fallbackProducts; }
  catch(e){ products=fallbackProducts; }
  renderProducts(); updateCart();
}
function renderProducts(){
  const q=$('#searchInput').value.trim().toLowerCase(), sort=$('#sortSelect').value;
  let list=products.filter(p=>(activeCategory==='all'||p.brand===activeCategory) && `${p.name} ${p.brand}`.toLowerCase().includes(q));
  if(sort==='low') list.sort((a,b)=>a.price-b.price);
  if(sort==='high') list.sort((a,b)=>b.price-a.price);
  if(sort==='rating') list.sort((a,b)=>b.rating-a.rating);
  $('#productCount').textContent=`Showing ${list.length} thoughtfully chosen ${list.length===1?'device':'devices'}`;
  $('#productGrid').innerHTML=list.length?list.map(p=>`
    <article class="product-card">
      <button class="product-image" data-view="${p.id}" aria-label="View ${escapeHTML(p.name)}">
        ${p.badge?`<span class="product-badge">${escapeHTML(p.badge)}</span>`:''}
        <img src="${escapeHTML(p.image_url)}" alt="${escapeHTML(p.name)}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=85'">
        <span class="quick-view">Quick view ↗</span>
      </button>
      <div class="product-info"><div class="product-brand">${escapeHTML(p.brand)}</div><div class="product-title-row"><h3>${escapeHTML(p.name)}</h3><span class="rating">★ ${Number(p.rating).toFixed(1)}</span></div>
      <div class="price-row"><strong>${money(p.price)}</strong>${p.old_price?`<del>${money(p.old_price)}</del>`:''}</div>
      <button class="add-button" data-add="${p.id}"><span>Add to bag</span><b>＋</b></button></div>
    </article>`).join(''):'<div class="no-results"><span>⌕</span><h3>No phones found</h3><p>Try another name or browse all phones.</p><button class="text-link" id="clearFilters">Clear filters →</button></div>';
}
function saveCart(){localStorage.setItem('novaCart',JSON.stringify(cart));updateCart();}
function updateCart(){
  const count=cart.reduce((s,i)=>s+i.quantity,0), total=cart.reduce((s,i)=>s+i.price*i.quantity,0);
  $('#cartCount').textContent=count; $('#drawerCount').textContent=`(${count})`; $('#cartSubtotal').textContent=money(total);
  $('#cartItems').innerHTML=cart.length?cart.map(i=>`<div class="cart-item"><img src="${escapeHTML(i.image_url)}" alt=""><div class="cart-item-info"><b>${escapeHTML(i.name)}</b><small>${money(i.price)}</small><div class="quantity-control"><button data-qty="${i.id}" data-change="-1">−</button><span>${i.quantity}</span><button data-qty="${i.id}" data-change="1">＋</button><button class="remove-item" data-remove="${i.id}">Remove</button></div></div><strong>${money(i.price*i.quantity)}</strong></div>`).join(''):'<div class="empty-cart"><span>♡</span><h4>Your bag is taking a little break.</h4><p>Find something you love and it’ll show up here.</p><button class="btn btn-primary" id="continueShopping">Explore phones</button></div>';
}
function addToCart(id){const p=products.find(x=>Number(x.id)===Number(id));if(!p)return;const found=cart.find(x=>Number(x.id)===Number(id));if(found)found.quantity=Math.min(10,found.quantity+1);else cart.push({...p,quantity:1});saveCart();toast(`${p.name} added to your bag`);}
function toast(msg){const t=$('#toast');t.textContent=msg;t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2600);}
function openCart(){ $('#overlay').classList.add('show');$('#cartDrawer').classList.add('open');document.body.classList.add('locked');}
function closePanels(){ $('#overlay').classList.remove('show');$('#cartDrawer').classList.remove('open');$('#productModal').classList.remove('open');$('#checkoutModal').classList.remove('open');document.body.classList.remove('locked');}
function showProduct(id){const p=products.find(x=>Number(x.id)===Number(id));if(!p)return;$('#productModalContent').innerHTML=`<div class="product-detail"><div class="detail-image"><img src="${escapeHTML(p.image_url)}" alt="${escapeHTML(p.name)}"></div><div class="detail-copy"><div class="eyebrow"><span class="eyebrow-line"></span>${escapeHTML(p.brand)}</div><h2>${escapeHTML(p.name)}</h2><div class="detail-rating">★ ${Number(p.rating).toFixed(1)} <span>· Nova customer rating</span></div><div class="detail-price">${money(p.price)} ${p.old_price?`<del>${money(p.old_price)}</del>`:''}</div><p>${escapeHTML(p.description)}</p><div class="stock-note">● In stock — ready to make yours</div><button class="btn btn-primary detail-add" data-add="${p.id}">Add to bag <span>→</span></button><div class="detail-perks">◇ Genuine device &nbsp; · &nbsp; ↗ Secure delivery</div></div></div>`;$('#overlay').classList.add('show');$('#productModal').classList.add('open');document.body.classList.add('locked');}
document.addEventListener('click',e=>{
 const add=e.target.closest('[data-add]');if(add){addToCart(add.dataset.add);if($('#productModal').classList.contains('open'))closePanels();return;}
 const view=e.target.closest('[data-view]');if(view){showProduct(view.dataset.view);return;}
 const remove=e.target.closest('[data-remove]');if(remove){cart=cart.filter(i=>Number(i.id)!==Number(remove.dataset.remove));saveCart();return;}
 const qty=e.target.closest('[data-qty]');if(qty){const item=cart.find(i=>Number(i.id)===Number(qty.dataset.qty));if(item){item.quantity+=Number(qty.dataset.change);if(item.quantity<1)cart=cart.filter(i=>i!==item);if(item.quantity>10)item.quantity=10;saveCart();}return;}
 if(e.target.closest('#continueShopping'))closePanels();
 if(e.target.closest('[data-close]'))closePanels();
 if(e.target.id==='clearFilters'){activeCategory='all';$('#searchInput').value='';document.querySelectorAll('.category-tab').forEach(b=>b.classList.toggle('active',b.dataset.category==='all'));renderProducts();}
});
$('#cartOpen').addEventListener('click',openCart);$('#cartClose').addEventListener('click',closePanels);$('#overlay').addEventListener('click',closePanels);
$('#categoryTabs').addEventListener('click',e=>{const b=e.target.closest('[data-category]');if(!b)return;activeCategory=b.dataset.category;document.querySelectorAll('.category-tab').forEach(x=>x.classList.toggle('active',x===b));renderProducts();});
$('#searchInput').addEventListener('input',renderProducts);$('#sortSelect').addEventListener('change',renderProducts);
$('.search-toggle').addEventListener('click',()=>{$('#searchInput').focus();$('#shop').scrollIntoView({behavior:'smooth'});});
$('#accountBtn').addEventListener('click',()=>toast('Guest shopping is ready — checkout only needs your delivery details.'));
$('#mobileMenu').addEventListener('click',()=>document.querySelector('.main-nav').classList.toggle('nav-open'));
$('#checkoutBtn').addEventListener('click',()=>{if(!cart.length){toast('Your bag is empty.');return;}$('#checkoutTotal').textContent=$('#cartSubtotal').textContent;$('#checkoutModal').classList.add('open');$('#cartDrawer').classList.remove('open');});
$('#checkoutForm').addEventListener('submit',async e=>{
 e.preventDefault();if(!cart.length)return;
 const form=Object.fromEntries(new FormData(e.target).entries());
 const payload={...form,items:cart.map(i=>({id:i.id,quantity:i.quantity}))};
 const btn=e.target.querySelector('button[type=submit]');btn.disabled=true;btn.textContent='Placing your order...';
 try{const r=await fetch('api/orders.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});const d=await r.json();if(!r.ok||!d.success)throw new Error(d.message||'Please try again.');
 $('#checkoutMessage').innerHTML=`<div class="success-box"><span>✓</span><h3>You're all set!</h3><p>${escapeHTML(d.message)}<br>Your order number is <b>#NOVA-${d.order_id}</b>.</p><button class="btn btn-primary" id="finishOrder">Continue exploring</button></div>`;
 cart=[];saveCart();e.target.reset();$('#checkoutForm').style.display='none';$('#checkoutMessage').style.display='block';
 }catch(err){toast(err.message);}finally{btn.disabled=false;btn.innerHTML='Place order <span>→</span>';}
});
document.addEventListener('click',e=>{if(e.target.id==='finishOrder'){closePanels();$('#checkoutForm').style.display='block';$('#checkoutMessage').style.display='none';}});
$('#newsletterForm').addEventListener('submit',async e=>{e.preventDefault();const email=$('#newsletterEmail').value;try{const r=await fetch('api/newsletter.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({email})});const d=await r.json();$('#newsletterMessage').textContent=d.message||'Thanks for joining us!';if(d.success)e.target.reset();}catch(err){$('#newsletterMessage').textContent='Please try again when you’re connected to the store.';}});
document.addEventListener('keydown',e=>{if(e.key==='Escape')closePanels();});
loadProducts();
