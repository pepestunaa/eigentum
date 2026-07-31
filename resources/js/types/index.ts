export interface Specification {
  bedroom?: string;
  bathroom?: string;
  building_area?: string;
}

export interface Type {
  name: string;
}

export interface Property {
  id: number;
  types?: Type;
  title?: string;
  image?: string;
  price_range?: string;
}

export interface Unit {
  id: number;
  title: string;
  description: string;
  price: number;
  image?: string;
  specifications?: Specification;
  properties?: Property;
  [key: string]: any;
}

export interface PaginatedData<T> {
  data: T[];
  links: { url: string | null; label: string; active: boolean }[];
}

export interface HeroSlide {
  title: string;
  subtitle: string;
  text: string;
}

export interface ServiceItem {
  icon: string;
  title: string;
  description: string;
}
