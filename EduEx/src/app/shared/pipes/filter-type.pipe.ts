import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'filterType'
})
export class FilterTypePipe implements PipeTransform {
  transform(array: Array<any>, args: string[]): Array<any> {
    if (array == null) {
      return null;
    }
    else if(args[1] === ''){
      return array;
    }
    return array.filter(item => item[args[0]] === args[1]);
  }

}
