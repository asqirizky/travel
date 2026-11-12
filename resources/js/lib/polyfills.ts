/**
 * Polyfill untuk browser lama (Firefox 89 di mesin ini).
 * File ini harus di-import paling awal di `app.ts`.
 */

// Object.hasOwn baru ada di Firefox 92.
if (!Object.hasOwn) {
    Object.defineProperty(Object, 'hasOwn', {
        configurable: true,
        writable: true,
        value: (object: object, property: PropertyKey): boolean =>
            Object.prototype.hasOwnProperty.call(object, property),
    });
}
