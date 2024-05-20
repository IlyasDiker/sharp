import {
    FormAutocompleteFieldData,
    FormDynamicOptionsData,
    FormFieldData,
    FormSelectFieldData,
    LayoutFieldData
} from "@/types";

export type FieldMeta = {
    locale?: string,
    uploading?: boolean,
    uploaded: true,
};
export type FieldsMeta = { [key: string]: FieldMeta };

type WithDynamicAttributesApplied<Data extends FormFieldData> =
    Data extends FormSelectFieldData
        ? Omit<FormSelectFieldData, 'options'> & { options: Exclude<FormSelectFieldData['options'], FormDynamicOptionsData> }
        : Data extends FormAutocompleteFieldData
            ? Omit<FormAutocompleteFieldData, 'localValues'> & { localValues: Exclude<FormAutocompleteFieldData['localValues'], FormDynamicOptionsData> }
            : Data;

export type FormFieldProps<Data extends FormFieldData = FormFieldData, Value = Data['value']> = {
    field: WithDynamicAttributesApplied<Data>,
    row: LayoutFieldData[],
    fieldLayout?: LayoutFieldData,
    fieldErrorKey?: string,
    hasError?: boolean,
    value?: Value,
    locale?: string | null,
    root?: boolean,
    id?: string,
}

export type FormFieldEmitInputOptions = { error?: string, force?: boolean };

export type FormFieldEmits<Data extends FormFieldData> = {
    (e: 'input', value: Data['value'], options?: FormFieldEmitInputOptions): void
    (e: 'error', error: string): void
    (e: 'clear'): void
}
