import moment from 'moment';

export function fromNow (time) {
  return moment(time, 'YYYY-MM-DD h:mm:ss').fromNow();
}

export function largeNumbers (number) {
    if (number > 999999) {
        return (number / 1000000).toFixed(1) + 'M';
    }
    
    if (number > 999) {
        return (number / 1000).toFixed(1) + 'k';
    }

    return number;
}

export function toLetter (num) {
    return ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'][num];
}

