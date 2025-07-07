// Estos imports son pertenecientes a un plugin de WP que facilita la creación de bloques
import { registerBlockType } from '@wordpress/blocks';
import { PanelBody, SelectControl, ColorPicker } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { useEffect, useState } from '@wordpress/element';

// Registra la función de renderizado del bloque
registerBlockType('plugin/client-block', {
    title: 'Cliente destacado',
    icon: 'admin-users',
    category: 'widgets',
    attributes: {
        clientId: { type: 'number' },
        background: { type: 'string', default: '#f9f9f9' }
    },
    edit({ attributes, setAttributes }) {
        const { clientId, background } = attributes;
        const [clients, setClients] = useState([]);

        // Obtiene entradas del CPT desde la API REST
        useEffect(() => {
            wp.apiFetch({ path: '/wp/v2/cliente?per_page=100' }).then((res) => {
                const options = res.map((client) => ({
                    label: client.title.rendered,
                    value: client.id
                }));
                setClients(options);
            });
        }, []);

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Configuración de cliente">
                        <SelectControl
                            label="Selecciona un cliente"
                            value={clientId}
                            options={[{ label: '— Elige —', value: 0 }, ...clients]}
                            onChange={(value) => setAttributes({ clientId: parseInt(value) })}
                        />
                        <ColorPicker
                            color={background}
                            onChangeComplete={(color) =>
                                setAttributes({ background: color.hex })
                            }
                            disableAlpha
                        />
                    </PanelBody>
                </InspectorControls>

                <div
                    style={{
                        background: background,
                        padding: '1em',
                        borderRadius: '6px'
                    }}
                >
                    <strong>
                        {clientId ? `ID de cliente seleccionado: ${clientId}` : 'Ningún cliente seleccionado'}
                    </strong>
                    <p>(La información general se mostrará en el renderizado)</p>
                </div>
            </>
        );
    },
    save() {
        return null; // Render dinamico manejado por PHP
    }
});
