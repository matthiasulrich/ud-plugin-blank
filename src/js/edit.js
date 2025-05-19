import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Blank-Plugin-Einstellung', 'ud-plugin-blank')} initialOpen={true}>
                    <TextControl
                        label={__('Text', 'ud-plugin-blank')}
                        value={attributes.content}
                        onChange={(value) => setAttributes({ content: value })}
                    />
                </PanelBody>
            </InspectorControls>
            <p>{attributes.content || __('Ein freundliches Hallo vom Blank-Plugin. Hier steht später dein Text.', 'ud-plugin-blank')}</p>
        </>
    );
}
