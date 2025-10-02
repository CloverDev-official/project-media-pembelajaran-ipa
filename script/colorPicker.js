function hexToHSL(H){
    let r=0,g=0,b=0;
    if(H.length==4){r="0x"+H[1]+H[1];g="0x"+H[2]+H[2];b="0x"+H[3]+H[3];}
    else if(H.length==7){r="0x"+H[1]+H[2];g="0x"+H[3]+H[4];b="0x"+H[5]+H[6];}
    r/=255; g/=255; b/=255;
    let cmin=Math.min(r,g,b),cmax=Math.max(r,g,b),delta=cmax-cmin,h=0,s=0,l=0;
    if(delta==0) h=0;
    else if(cmax==r) h=((g-b)/delta)%6;
    else if(cmax==g) h=(b-r)/delta+2;
    else h=(r-g)/delta+4;
    h=Math.round(h*60); if(h<0) h+=360;
    l=(cmax+cmin)/2;
    s=delta==0?0:delta/(1-Math.abs(2*l-1));
    s=+(s*100).toFixed(1); l=+(l*100).toFixed(1);
    return {h,s,l};
}
function hslToHex(h,s,l){
    s/=100;l/=100;
    let c=(1-Math.abs(2*l-1))*s;
    let x=c*(1-Math.abs((h/60)%2-1));
    let m=l-c/2; let r=0,g=0,b=0;
    if(0<=h && h<60){r=c;g=x;b=0;}
    else if(60<=h && h<120){r=x;g=c;b=0;}
    else if(120<=h && h<180){r=0;g=c;b=x;}
    else if(180<=h && h<240){r=0;g=x;b=c;}
    else if(240<=h && h<300){r=x;g=0;b=c;}
    else {r=c;g=0;b=x;}
    r=Math.round((r+m)*255); g=Math.round((g+m)*255); b=Math.round((b+m)*255);
    return "#"+((1<<24)+(r<<16)+(g<<8)+b).toString(16).slice(1).toUpperCase();
}
function generateCustomPalette(base){
    const hsl = hexToHSL(base);
    const steps = {50:95,100:88,200:75,300:60,400:50,500:45,600:38,700:30,800:22,900:15,950:10};
    for(let key in steps){
        const color = hslToHex(hsl.h,hsl.s,steps[key]);
        document.documentElement.style.setProperty(`--primary-${key}`, color);
    }
    document.body.setAttribute('data-theme','custom');
    localStorage.setItem('theme','custom');
    localStorage.setItem('primaryPalette', JSON.stringify({baseColor: base}));
}

document.addEventListener("DOMContentLoaded", ()=>{
    const picker = document.getElementById('picker');
    if(!picker) return;

    const saved = localStorage.getItem('primaryPalette');
    if(saved){
        const {baseColor} = JSON.parse(saved);
        if(baseColor && localStorage.getItem("theme")==="custom"){
            picker.value = baseColor;
            generateCustomPalette(baseColor);
        }
    }

    picker.addEventListener('input', e=>generateCustomPalette(e.target.value));
});
