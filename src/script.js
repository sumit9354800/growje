// Scroll observer animation
const marquee = document.getElementById("image-marquee");

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                marquee.classList.add("reveal-marquee");
            } else {
                marquee.classList.remove("reveal-marquee");
            }
        });
    },
    { threshold: 0.3 }
);

observer.observe(marquee);


// Service Buttons Functionality

const webBtn = document.getElementById("webBtn");
const graphicBtn = document.getElementById("graphicBtn");
const videoBtn = document.getElementById("videoBtn");
const seoBtn = document.getElementById("seoBtn");
const performanceBtn = document.getElementById("performanceBtn");
const printingBtn = document.getElementById("printingBtn");
const imageRender = document.getElementById("imageRender");
const textRender = document.getElementById("textRender");


const buttons = [webBtn, graphicBtn, videoBtn, seoBtn, performanceBtn, printingBtn];

function setActive(btn) {
    buttons.forEach(b => b.classList.remove("activeBtn"));
    btn.classList.add("activeBtn");
}

const renderWeb = () => {
    textRender.innerText = `From interactive business sites to robust eCommerce platforms — we deliver websites that perform as great as they look.`;
    imageRender.src = `https://i.pinimg.com/1200x/22/bc/8e/22bc8ebef610eb881071e1a7007a7a80.jpg`
    setActive(webBtn);
}

const renderGraphic = () => {
    textRender.innerText = `Bold. Emotional. Memorable. Our designs inspire and connect your audience with your brand.`;
    imageRender.src = `https://i.pinimg.com/1200x/70/98/53/709853257f4f326ae00c182980f97abe.jpg`
    setActive(graphicBtn);
}

const renderVideo = () => {
    textRender.innerText = `We transform ideas into motion. Each frame, cut, and transition is crafted to captivate your audience.`;
    imageRender.src = `https://i.pinimg.com/736x/91/53/1a/91531ad1a3e6b05d43ecfd0af98a779f.jpg`
    setActive(videoBtn);
}

const renderSEO = () => {
    textRender.innerText = `We connect brands with their audience using performance-driven strategies that maximize conversions.`;
    imageRender.src = `https://i.pinimg.com/736x/1e/22/c2/1e22c2679b7d464b0349c80edd1f5c8e.jpg`
    setActive(seoBtn);
}

const renderPerformance = () => {
    textRender.innerText = `We transform ideas into motion. Each frame, cut, and transition is crafted to captivate your audience.`;
    imageRender.src = `https://i.pinimg.com/1200x/b3/02/77/b30277ab18dc809d4c7f59b3c21ee102.jpg`
    setActive(performanceBtn);
}

const renderPrinting = () => {
    textRender.innerText = `We connect brands with their audience using performance-driven strategies that maximize conversions.`;
    imageRender.src = `https://i.pinimg.com/1200x/03/cd/61/03cd61fc4e1f3a4a31cfff9d721351da.jpg`
    setActive(printingBtn);
}

renderWeb();

webBtn.addEventListener("click", renderWeb);
graphicBtn.addEventListener("click", renderGraphic);
videoBtn.addEventListener("click", renderVideo);
seoBtn.addEventListener("click", renderSEO);
performanceBtn.addEventListener("click", renderPerformance);
printingBtn.addEventListener("click", renderPrinting);


const differenceBtn1 = document.getElementById("differenceBtn1");
const differenceBtn2 = document.getElementById("differenceBtn2");
const differenceBtn3 = document.getElementById("differenceBtn3");
const differenceBtn4 = document.getElementById("differenceBtn4");
const differenceBtn5 = document.getElementById("differenceBtn5");
const differenceBtn6 = document.getElementById("differenceBtn6");
const headingDifference = document.getElementById("headingDifference");
const paraDifference = document.getElementById("paraDifference");
const imgDifference = document.getElementById("imgDifference");


const buttons2 = [differenceBtn1, differenceBtn2, differenceBtn3, differenceBtn4, differenceBtn5, differenceBtn6];

function setActiveDif(btn) {
    buttons2.forEach(b => b.classList.remove("activeDif"));
    btn.classList.add("activeDif");
}

const renderDefference1 = () => {
    headingDifference.innerText = `Custom Solutions`;
    paraDifference.innerText = `As a reputable digital marketing agency operating in India, we develop strategies and tactics to achieve your goals while keeping business results in mind.`;
    imgDifference.src = `https://rapiddigitalgrowth.com/assets/hwd-analytics.png`
    setActiveDif(differenceBtn1);
}

const renderDefference2 = () => {
    headingDifference.innerText = `One-Stop Solutions`;
    paraDifference.innerText = `Our digital marketing services in India encompass everything from SEO, digital, paid online advertising and much more, offering a full-service approach to enhance your business's online growth.`;
    imgDifference.src = `https://rapiddigitalgrowth.com/assets/customized-budget.png`
    setActiveDif(differenceBtn2);
}

const renderDefference3 = () => {
    headingDifference.innerText = `Transparent Pricing`;
    paraDifference.innerText = `As an budget friendly marketing agency, we pride ourselves on efficiently offering unbeatable quality without over-promising or overcharging.`;
    imgDifference.src = `https://rapiddigitalgrowth.com/assets/security.png`
    setActiveDif(differenceBtn3);
}

const renderDefference4 = () => {
    headingDifference.innerText = `Execution Methodology`;
    paraDifference.innerText = `Your competitors are our competitors. Therefore, we give our customers access to the tools, techniques and new ideas to stay ahead.`;
    imgDifference.src = `https://rapiddigitalgrowth.com/assets/dynamic-website.png`
    setActiveDif(differenceBtn4);
}

const renderDefference5 = () => {
    headingDifference.innerText = `Personalized Experience`;
    paraDifference.innerText = `Our focus is on producing an individualized marketing experience with on-going years of support for your business to succeed.`;
    imgDifference.src = `https://rapiddigitalgrowth.com/assets/fit-budget.png`
    setActiveDif(differenceBtn5);
}

const renderDefference6 = () => {
    headingDifference.innerText = `Ethical Practices`;
    paraDifference.innerText = `As a reliable digital marketing service provider, we uphold integrity and ethical standards in all our dealings.`;
    imgDifference.src = `https://rapiddigitalgrowth.com/assets/develop-relations.png`
    setActiveDif(differenceBtn6);
}

renderDefference1();

differenceBtn1.addEventListener("click", renderDefference1);
differenceBtn2.addEventListener("click", renderDefference2);
differenceBtn3.addEventListener("click", renderDefference3);
differenceBtn4.addEventListener("click", renderDefference4);
differenceBtn5.addEventListener("click", renderDefference5);
differenceBtn6.addEventListener("click", renderDefference6);


// https://freefrontend.com/ carousel code

// carousel start

const panels = document.querySelectorAll('.panel');
let currentIndex = 0;

// Manual click support (aapka existing behavior)
panels.forEach(function (panel, index) {
    panel.addEventListener('click', function () {
        removeActiveClasses();
        panel.classList.add('active');
        currentIndex = index; // auto slider yahin se continue ho
    });
});

// Auto change every 2 seconds
setInterval(function () {
    removeActiveClasses();

    currentIndex++;

    if (currentIndex >= panels.length) {
        currentIndex = 0; // wapas first se start
    }

    panels[currentIndex].classList.add('active');
}, 4000); // 2000ms = 2 sec

function removeActiveClasses() {
    panels.forEach(function (panel) {
        panel.classList.remove('active');
    });
}
// carousel end

// portfolio

let plus = document.getElementById('plus');

let dropdown = document.getElementById('dropdown');

plus.addEventListener('click', function(){
  dropdown.classList.toggle('show');
});
