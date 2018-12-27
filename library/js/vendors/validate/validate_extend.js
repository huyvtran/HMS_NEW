

// Extend for date roll from  https://validatejs.org/#validators-datetime

// Before using it we must add the parse and format functions
// Here is a sample implementation using moment.js
validate.extend(validate.validators.datetime, {
    // The value is guaranteed not to be null or undefined but otherwise it
    // could be anything.
    parse: function(value, options) {
        var format = '';
        if(typeof options.format !== 'undefined') {
            format =options.format;
        }
        else {
            if (typeof g_date_format !== 'undefined') {
                switch(g_date_format) {
                    case "0":
                        format = 'YYYY-MM-DD';
                        break;
                    case "1":
                        format = 'MM/DD/YYYY';
                        break;
                    case "2":
                        format = 'DD/MM/YYYY';
                        break;
                    default:
                        format = 'YYYY-MM-DD';
                }
            }
            else{format = 'YYYY-MM-DD';} //default
        }
        return (moment.utc(value, format));
    },
    // Input is a unix timestamp
    format: function(value, options) {
        var format = '';
        if (options.dateOnly){
            if(typeof options.format !== 'undefined') {
                format =options.format;
            }
            else {
                if (typeof g_date_format !== 'undefined') {
                    switch(g_date_format) {
                        case "0":
                            format = 'YYYY-MM-DD';
                            break;
                        case "1":
                            format = 'MM/DD/YYYY';
                            break;
                        case "2":
                            format = 'DD/MM/YYYY';
                            break;
                        default:
                            format = 'YYYY-MM-DD';
                    }
                }
                else{format = 'YYYY-MM-DD';} //default
            }
        }else{
            format="YYYY-MM-DD hh:mm:ss";
        }

        return (moment.utc(value, format));
    }
});


/*
*  Custom validator documentation - https://validatejs.org/#custom-validator
*/

/**
* validate that date is past date, recommended to put it after {date: {dateOnly: true}}
* you can specify the message option {onlyPast:{message:'text example'}}
* optional options -
* 1)(string) massage
* 2)(boolean) onlyYear
*/
validate.validators.pastDate = function(value, options) {
    //exit if empty value
    if(validate.isEmpty(value)) { return;}
    // exit if options = false
    if(!options) return;
    //Without this fix an empty date doesn't pass validation because value in DB is "0000-00-00".
    if(value == "0000-00-00"){
        return;
    }
    var now = new Date().getTime();
    //if set onlyYear option
    if (options.onlyYear != undefined && options.onlyYear) {
        if(value < 1800 || value > now.getFullYear ) {

            return throwError('Must be year format');
        }
        else return; // passed only year validation
    }

    var format=0;
    if (typeof(g_date_format) !== 'undefined') {
        format=g_date_format;
    }

    var date = '';

        switch(format) {
            // case date format is dd/mm/YYYY
            case "2":
                var dateParts = value.split("/");
                var date = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
                break;
            default:
                date =  new Date(value);
        }


    var mls_date = date.getTime();
    if(isNaN(mls_date)) {
       return throwError('Must be valid date');
    }

    if(now < mls_date) {

       return throwError( 'Must be past date');
    }

    // throw error
    function throwError(message){
        if(validate.isObject(options) && options.message != undefined) {
            return options.message;
        } else {
            return message;
        }
    }
};


/**
 * Luhn algorithm in JavaScript: validate credit card number supplied as string of numbers
 * @author ShirtlessKirk. https://gist.github.com/ShirtlessKirk/2134376
 * you can specify the message option {luhn:{message:'text example'}}
 *
 */

validate.validators.luhn = function(value, options) {

    //calculate Luhn algorithm
    var luhnChk = (function (arr) {
        return function (ccNum) {
            var
                len = ccNum.length,
                bit = 1,
                sum = 0,
                val;

            while (len) {
                val = parseInt(ccNum.charAt(--len), 10);
                sum += (bit ^= 1) ? arr[val] : val;
            }

            return sum && sum % 10 === 0;
        };
    }([0, 2, 4, 6, 8, 1, 3, 5, 7, 9]));

    //exit if empty value
    if(validate.isEmpty(value)) { return; }
    // exit if options = false
    if(!options) return;

    var valid = luhnChk(value);

    if(!valid) {
        if(validate.isObject(options) && options.message != undefined) {
            return options.message;
        } else {
            return 'Invalid luhn algorithm';
        }
    }
}



