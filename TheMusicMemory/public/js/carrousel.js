(() => {
const root = document.querySelector("[data-carousel]");
if (!root) return;

// ---- 1. Données ----
const R2 = root.dataset.imgBase; // fourni par la page Blade (data-img-base)
const U = (id) =>
    `https://images.unsplash.com/photo-${id}?w=640&h=640&fit=crop&q=70&auto=format`;

const slides = [
    // {
    //     src: `${R2}/ddcbee38be8b7274e19e132d7ab35b53.jpg`,
    //     alt: "Main dont les doigts laissent passer un oiseau",
    //     title: "Open Palm",
    //     subtitle: "Single",
    //     year: "2020",
    //     producer: "Ada Ferrow",
    //     length: "3:01",
    // },
    {
        src: U("1470071459604-3b5ec3a7fe05"),
        alt: "Brouillard dans une vallée boisée",
        title: "Low Country",
        subtitle: "Long Player",
        year: "2017",
        producer: "Sim Oyo",
        length: "5:20",
    },
    {
        src: U("1500534314209-a25ddb2bd429"),
        alt: "Crête de dune sous un ciel bleu",
        title: "Dry Season",
        subtitle: "EP",
        year: "2016",
        producer: "Juno Vale",
        length: "2:44",
    },
    {
        src: U("1441974231531-c6227db76b6e"),
        alt: "Lumière à travers une forêt dense",
        title: "Understory",
        subtitle: "Single",
        year: "2023",
        producer: "Kell Mora",
        length: "3:38",
    },
    {
        src: U("1493246507139-91e8fad9978e"),
        alt: "Fumée colorée pastel sur fond pâle",
        title: "Paper Lantern",
        subtitle: "Single",
        year: "2021",
        producer: "Rue Alcott",
        length: "2:19",
    },
    {
        src: U("1501785888041-af3ef285b470"),
        alt: "Lac de montagne reflétant une crête au crépuscule",
        title: "Still Water",
        subtitle: "Long Player",
        year: "2015",
        producer: "Ada Ferrow",
        length: "4:51",
    },
    {
        src: U("1465101162946-4377e57745c3"),
        alt: "Pose longue de traînées de lumière sur un paysage sombre",
        title: "Third Rail",
        subtitle: "EP",
        year: "2024",
        producer: "Sim Oyo",
        length: "3:07",
    },
    {
        src: U("1519681393784-d120267933ba"),
        alt: "Sommet enneigé éclairé par le soleil du matin",
        title: "Undertow",
        subtitle: "Single",
        year: "2020",
        producer: "Juno Vale",
        length: "3:29",
    },
];

// ---- 2. Création des images ----
const stage = root.querySelector("[data-stage]");
const caption = root.querySelector("[data-caption]");
let active = 0;

const imgs = slides.map((s, i) => {
    const img = document.createElement("img");
    img.className = "tmm-slide";
    img.src = s.src;
    img.alt = s.alt;
    img.tabIndex = 0;
    img.addEventListener("click", () => go(i));
    stage.appendChild(img);
    return img;
});

// ---- 3. Positionnement 3D selon la distance à la slide active ----
function render() {
    imgs.forEach((img, i) => {
        const d = i - active; // distance à la slide active
        const abs = Math.abs(d);
        const x = d * 70 + Math.sign(d) * (abs ? 110 : 0); // espace autour du centre
        const rotate = d === 0 ? 0 : d > 0 ? -55 : 55;
        const z = d === 0 ? 0 : -120 - abs * 40;

        img.style.transform = `translateX(${x}px) translateZ(${z}px) rotateY(${rotate}deg)`;
        img.style.zIndex = 100 - abs;
        img.style.opacity = abs > 4 ? 0 : 1 - abs * 0.15;
        img.style.pointerEvents = abs > 4 ? "none" : "auto";
        img.style.filter = d === 0 ? "none" : "brightness(.6)";
    });

    const s = slides[active];
    const field = (label, value) => {
        const box = document.createElement("div");
        const tag = document.createElement("span");
        tag.textContent = label;
        box.append(tag, document.createTextNode(value));
        return box;
    };
    const title = document.createElement("h2");
    title.textContent = s.title;
    const sub = document.createElement("p");
    sub.className = "tmm-caption__sub";
    sub.textContent = s.subtitle;
    const meta = document.createElement("div");
    meta.className = "tmm-meta";
    meta.append(
        field("Année", s.year),
        field("Producteur", s.producer),
        field("Durée", s.length),
    );
    caption.replaceChildren(title, sub, meta);
}

function go(i) {
    active = Math.max(0, Math.min(slides.length - 1, i));
    render();
}

// ---- 4. Contrôles : boutons, clavier, glissement tactile ----
root.querySelector("[data-prev]").onclick = () => go(active - 1);
root.querySelector("[data-next]").onclick = () => go(active + 1);
document.addEventListener("keydown", (e) => {
    const t = e.target;
    if (t instanceof HTMLElement && (t.isContentEditable || /^(INPUT|TEXTAREA|SELECT)$/.test(t.tagName))) return;
    if (e.key === "ArrowLeft") go(active - 1);
    if (e.key === "ArrowRight") go(active + 1);
});

let startX = null;
stage.addEventListener("pointerdown", (e) => (startX = e.clientX));
stage.addEventListener("pointerup", (e) => {
    if (startX === null) return;
    const dx = e.clientX - startX;
    if (Math.abs(dx) > 50) go(active + (dx < 0 ? 1 : -1));
    startX = null;
});

go(Math.floor(slides.length / 2)); // démarre au milieu

})();