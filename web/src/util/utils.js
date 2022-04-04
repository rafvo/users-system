export class Utils {
  /**
   * Rounds a value using javascript Math.round and uses precision param to define how many decimal places will be considered
   * @param {double} value 
   * @param {int} precision 
   */
  static round(value, precision) {
    var shift = function (value, precision) {
      var numArray = ("" + value).split("e");
      return +(numArray[0] + "e" + (numArray[1] ? (+numArray[1] + precision) : precision));
    };
    return shift(Math.round(shift(value, +precision)), -precision);
  }

  static exist = (data) => {
    const valid = Boolean(data && typeof data !== undefined);
    if (!valid) return false;

    if (data instanceof Array) return Boolean(data.length > 0);

    else if (data instanceof Object)
      return Boolean(
        Object.keys(data).length > 0
      );

    else return Boolean(data);
  }

  static existArray = (value) => {
    return Boolean(
      typeof value !== undefined
      && value
      && value instanceof Array
      && value.length > 0
    );
  }

  static existObject = (value) => {
    return Boolean(
      typeof value !== undefined
      && value
      && value instanceof Object
      && Object.keys(value).length > 0
    );
  }

  static existValue = (value) => {
    return Boolean(
      typeof value !== undefined
      && value
    );
  }
}