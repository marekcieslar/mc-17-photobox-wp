let mcModal = document.createElement('div');
mcModal.classList.add('mc-17-modal');
document.body.appendChild(mcModal);

let mcModalBackground = document.createElement('div');
mcModalBackground.classList.add('mc-17-modal-background');
mcModalBackground.addEventListener('click', () => {
    mcCloseModal();
})
mcModal.appendChild(mcModalBackground);

function mcCloseModal() {
    mcModal.classList.remove('mc-visible');
}

let mcImg = document.createElement('img');
mcModal.appendChild(mcImg);

let mcDesc = document.createElement('p');
mcModal.appendChild(mcDesc);

/*
 * SWIPE IMAGE
 */
const MINIMUM_SWIPE_DIST = 100;
const MAXIMUM_TIME = 350;
let startSwipeX;
let startSwipeY;
let startTime;
mcImg.addEventListener('touchstart', e => {
    startSwipeX = e.changedTouches[0].clientX;
    startSwipeY = e.changedTouches[0].clientY;
    startTime = Date.now();
})

mcImg.addEventListener('touchend', e => {
    let swipeDiffX = startSwipeX - e.changedTouches[0].clientX;
    let swipeDiffY = startSwipeY - e.changedTouches[0].clientY;
    let timeDiff = Date.now() - startTime;
    if (timeDiff < MAXIMUM_TIME) {
        if (Math.abs(swipeDiffX) > MINIMUM_SWIPE_DIST) {
            if (swipeDiffX < 0) {
                mcOpenPhoto(prevImg);
            } else {
                mcOpenPhoto(nextImg);
            }
        } else if (Math.abs(swipeDiffY) > MINIMUM_SWIPE_DIST) {
            mcCloseModal();
        }
    }
});

let mcBtnClose = document.createElement('button');
mcBtnClose.classList.add('mc-btn');
mcBtnClose.classList.add('mc-btn-close');
mcBtnClose.innerHTML = 'X'
mcModal.appendChild(mcBtnClose);
mcBtnClose.addEventListener('click', () => {
    mcCloseModal();
});

let mcBtnPrev = document.createElement('button');
mcBtnPrev.classList.add('mc-btn');
mcBtnPrev.classList.add('mc-btn-prev');
mcBtnPrev.innerHTML = '&lt;'
mcModal.appendChild(mcBtnPrev);

let mcBtnNext = document.createElement('button');
mcBtnNext.classList.add('mc-btn');
mcBtnNext.classList.add('mc-btn-next');
mcBtnNext.innerHTML = '&gt;'
mcModal.appendChild(mcBtnNext);

// to add event listener to all gallery photos

let mcGalleryThumbs = document.getElementsByClassName('link-to-full-img');
let prevImg = 0;
let nextImg = 0;
let l = mcGalleryThumbs.length;
for (let i = 0; i < l; i++) {
    let thumb = mcGalleryThumbs[i];
    thumb.addEventListener('click', e => {
        e.preventDefault();
        mcOpenPhoto(i);
    });
}

// to open single photo from gallery

function mcOpenPhoto(x) {
    mcModal.classList.add('mc-visible');
    mcImg.src = mcGalleryThumbs[x].href;
    let imgDescription = mcGalleryThumbs[x].childNodes[0].dataset.description;
    if (imgDescription) {
        mcDesc.innerHTML = imgDescription;
        mcDesc.style.display = 'block';
    }
    else {
        mcDesc.style.display = 'none';
    }
    prevImg = x <= 0 ? l - 1 : x - 1;
    nextImg = x >= l - 1 ? 0 : x + 1;
}

mcBtnPrev.addEventListener('click', () => {
    mcOpenPhoto(prevImg);
});

mcBtnNext.addEventListener('click', () => {
    mcOpenPhoto(nextImg);
});