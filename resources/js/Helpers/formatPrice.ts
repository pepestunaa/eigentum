export const formatPrice = (price: number | string): string => {
  if (typeof price === 'string' && price.includes('-')) {
    return price;
  }
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(Number(price));
};
