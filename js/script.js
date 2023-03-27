function enviar() {
    document.getElementById("submitForm").reset();
}

function openModal(cardId) {
    const card = document.getElementById(cardId);
    const title = card.getElementsByTagName('p')[0].innerText;
    const imageSrc = card.getElementsByTagName('img')[0].getAttribute('src');
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modal-title');
    const modalImage = document.getElementById('modal-image');
    const modalBodyText = document.getElementById('modal-body-text');
    
    modalTitle.innerText = title;
    modalImage.src = imageSrc;
    modalBodyText.innerText = "";
    modal.style.display = 'block';
}

document.getElementById('friends').addEventListener('click', function() {
    openModal('friends');
    const modalBodyText = document.getElementById('modal-body-text');
    modalBodyText.innerText = "Seis amigos, três homens e três mulheres, enfrentam a vida e os amores em Nova York e adoram passar o tempo livre na cafeteria Central Perk.";
});

document.getElementById('theOffice').addEventListener('click', function() {
    openModal('theOffice');
    const modalBodyText = document.getElementById('modal-body-text');
    modalBodyText.innerText = "Esta versão americana de 'The Office' é uma comédia que gira em torno do cotidiano de um escritório. Esta sátira descreve a vida dos funcionários da fábrica de papel Dunder Miffin, situada em Scranton, na Pensilvânia";
});

document.getElementById('velozes_furiosos').addEventListener('click', function() {
    openModal('velozes_furiosos');
    const modalBodyText = document.getElementById('modal-body-text');
    modalBodyText.innerText = "Dominic Toretto e Letty vivem uma vida pacata ao lado do filho. Mas eles logo são ameaçados pelo passado de Dom: seu irmão desaparecido Jakob, que retorna e está trabalhando ao lado de Cipher.";
});


function closeModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
}

window.addEventListener('click', function(event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        closeModal();
    }
});