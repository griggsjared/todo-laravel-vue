export interface ICategory {
  uuid: string;
  name: string;
}

export interface ITodo {
  uuid: string;
  name: string;
  is_complete: boolean;
  category: ICategory;
}
