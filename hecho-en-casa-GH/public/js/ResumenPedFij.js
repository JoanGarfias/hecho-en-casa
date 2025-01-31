document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".descargarPDF-button").addEventListener("click", generatePDF);
});

async function generatePDF() {
    console.log("Generando PDF...");
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const CONFIG = {
        font: "Poppins",
        primaryColor: "#7E643B",
        secondaryColor: "#333",
        highlightColor: "#af2424",
        buttonColor: [251, 175, 53],
        marginX: 20,
        startY: 20,
    };

    const pageWidth = doc.internal.pageSize.getWidth();
    let y = CONFIG.startY;

    // 1. Cargar y agregar logo
    const logoImg = document.querySelector("#logo-hidden").src;
    await addLogoToPDF(doc, logoImg, CONFIG.marginX, y);
    y += 25; // Espacio después del logo

    // 2. Título principal
    addTitle(doc, "Resumen de Pedido", pageWidth / 2, y, CONFIG);
    y += 15;

    // 3. Línea divisoria
    addDivider(doc, CONFIG.marginX, y, pageWidth, CONFIG.primaryColor);
    y += 10;

    // 4. Información del folio
    const folioValue = getFieldValue("folio", "N/A");
    addFolioInfo(doc, "Pedido con folio:", `Folio: ${folioValue}`, CONFIG.marginX, y, CONFIG);
    y += 15;

    // 5. Otra línea divisoria
    addDivider(doc, CONFIG.marginX, y, pageWidth, CONFIG.primaryColor);
    y += 10;

    // 6. Información detallada
    const fields = [
        { label: "Tipo de postre", id: "tipo_postre" },
        { label: "Sabor", id: "sabor" },
        { label: "Porciones", id: "porciones" },
        { label: "Nombre", id: "nombre" },
        { label: "Teléfono", id: "telefono" },
        { label: "Fecha de entrega", id: "fecha_entrega" },
        { label: "Hora de entrega", id: "hora_entrega" },
        { label: "Tipo de entrega", id: "tipo_entrega" },
        { label: "Costo Aproximado", id: "costo_aproximado" },
    ];

    fields.forEach(field => {
        const value = getFieldValue(field.id, "N/A");
        y = addFieldWithValue(doc, field.label, value, CONFIG.marginX, y, pageWidth, CONFIG);
    });

    // 7. Botón decorativo
    addDecorativeButton(doc, "Gracias por tu preferencia", CONFIG.marginX, y, pageWidth, CONFIG);

    // 8. Guardar PDF
    doc.save(`Resumen_Pedido_${folioValue}.pdf`);
}

// Funciones auxiliares

function addLogoToPDF(doc, logoSrc, x, y) {
    return new Promise(resolve => {
        const logoImg = new Image();
        logoImg.src = logoSrc;
        logoImg.onload = () => {
            doc.addImage(logoImg, "PNG", x, y, 30, 30); // Tamaño del logo
            resolve();
        };
        logoImg.onerror = () => {
            console.error("Error al cargar el logo:", logoSrc);
            resolve(); // Continuar incluso si falla el logo
        };
    });
}

function addTitle(doc, text, x, y, config) {
    doc.setFont(config.font, "sans-serif");
    doc.setFontSize(22);
    doc.setTextColor(config.primaryColor);
    doc.text(text, x, y, { align: "center" });
}

function addDivider(doc, x, y, pageWidth, color) {
    doc.setDrawColor(...hexToRGB(color));
    doc.line(x, y, pageWidth - x, y);
}

function addFolioInfo(doc, label, value, x, y, config) {
    doc.setFont(config.font, "sans-serif");
    doc.setFontSize(16);
    doc.setTextColor(config.secondaryColor);
    doc.text(label, x, y);
    doc.setTextColor(config.highlightColor);
    doc.text(value, x + 50, y);
}

function addFieldWithValue(doc, label, value, x, y, pageWidth, config) {
    doc.setFontSize(12);
    doc.setFont(config.font, "sans-serif");
    doc.setTextColor(config.primaryColor);
    doc.text(`${label}:`, x, y);

    doc.setTextColor(config.secondaryColor);
    const textLines = doc.splitTextToSize(value, pageWidth - x * 4);
    doc.text(textLines, x + 40, y);
    return y + textLines.length * 7; // Ajustar el espacio dinámicamente
}

function addDecorativeButton(doc, text, x, y, pageWidth, config) {
    doc.setFillColor(...config.buttonColor);
    doc.rect(x, y, pageWidth - x * 2, 10, "F");
    doc.setFontSize(12);
    doc.setTextColor("#FFF");
    doc.text(text, pageWidth / 2, y + 7, { align: "center" });
}

function getFieldValue(id, defaultValue = "") {
    const element = document.getElementById(id);
    return element?.value?.trim() || defaultValue;
}

function hexToRGB(hex) {
    const bigint = parseInt(hex.slice(1), 16);
    return [(bigint >> 16) & 255, (bigint >> 8) & 255, bigint & 255];
}
