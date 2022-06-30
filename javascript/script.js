//Maakt de presentietabel onzichtbaar en de ziekmeldingtabel zichtbaar en andersom op button click.
function veranderTabel() {
    const x = document.getElementById("presentieTabel");
    const y = document.getElementById("ziekmeldingTabel");
    const a = document.getElementById("btnPresentie");
    const b = document.getElementById("btnZiekmelding");
    const statePresentie = x.style.display == "block";
    x.style.display = statePresentie ? 'none' : 'block';
    y.style.display = statePresentie ? 'block' : 'none';
    a.disabled = statePresentie ? '' : 'disabled';
    b.disabled = statePresentie ? 'disabled' : '';
}