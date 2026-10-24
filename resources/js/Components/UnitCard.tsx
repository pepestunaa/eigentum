import React from 'react';
import { Link } from '@inertiajs/react';
import { formatPrice } from '@/Helpers/formatPrice';
import type { Unit } from '@/types';

const spec = (u: Unit, key: string) => u.specifications?.[key as keyof NonNullable<Unit['specifications']>];

export function favUnit(unitId: number, active: boolean) {
    fetch(active ? `/favorite-remove/${unitId}` : `/favorite-add/${unitId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content ?? '',
            'X-Requested-With': 'XMLHttpRequest',
        },
    }).catch(() => { window.location.href = '/session/auth/user/signin'; });
}

export default function UnitCard({ unit }: { unit: Unit }) {
    const image = unit.image ? `/storage/${unit.image}` : '/assets/pages/Home/unit1.jpg';
    const address = unit.properties?.address ?? unit.properties?.title ?? 'Indonesia';

    return (
        <article className="k-card">
            <Link href={`/pages/unit/${unit.id}`} className="k-card__media" aria-label={unit.title}>
                <img src={image} alt={unit.title} loading="lazy" />
                <div className="k-card__media-tags">
                    <span className="k-lot">KVL-{String(unit.id).padStart(4, '0')}</span>
                    {spec(unit, 'bedroom') && <span className="k-badge k-badge--soft">{spec(unit, 'bedroom')} KT</span>}
                </div>
            </Link>
            <div className="k-card__body">
                <span className="k-card__price">{formatPrice(unit.price)}</span>
                <Link href={`/pages/unit/${unit.id}`} className="k-card__title">{unit.title}</Link>
                <span className="k-card__loc">
                    <svg className="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <path d="M12 21s-7-5.5-7-11a7 7 0 1 1 14 0c0 5.5-7 11-7 11Z" />
                        <circle cx="12" cy="10" r="2.5" />
                    </svg>
                    {address}
                </span>
                <div className="k-card__specs">
                    {spec(unit, 'bedroom') && <span>{spec(unit, 'bedroom')} Kamar</span>}
                    {spec(unit, 'bathroom') && <span>{spec(unit, 'bathroom')} Mandi</span>}
                    {spec(unit, 'building_area') && <span>{spec(unit, 'building_area')} m²</span>}
                </div>
            </div>
        </article>
    );
}
