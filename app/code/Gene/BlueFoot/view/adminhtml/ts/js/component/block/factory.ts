import Block from './block';
import Stage from "../stage";
import EditableArea from "../stage/structural/editable-area";
import loadModule from 'Gene_BlueFoot/js/component/loader';


interface ConfigObject {
    js_block?: string;
    [key: string]: any
}

/**
 * Retrieve the block instance from the config object
 *
 * @param config
 * @returns {any|string}
 */
function getBlockComponentPath(config: ConfigObject): string {
    return config.js_block || 'Gene_BlueFoot/js/component/block/block';
}

/**
 * Create a new instance of a block
 *
 * @param config
 * @param parent
 * @param stage
 * @param formData
 * @returns {Promise<BlockInterface>}
 */
// export default async function createBlock(config: ConfigObject, parent: EditableAreaInterface, stage: StageInterface, formData?: object): Promise<Block> {
//     let c: typeof Block = await import(getBlockComponentPath(config));
//     return new c(parent, stage || parent.stage, config, formData || {});
// }
export default function createBlock(config: ConfigObject, parent: EditableArea, stage: Stage, formData?: object): Promise<Block> {
    const appearanceApplierComponentName: string = 'Gene_BlueFoot/js/utils/appearance-applier';

    stage = stage || parent.stage;
    formData = formData || {};
    return new Promise(function (resolve, reject) {
        loadModule([appearanceApplierComponentName], function(appearanceApplier) {
            loadModule(config['appearances'], function(...components) {
                let appearanceComponents: any = {};
                Object.keys(components).map(
                    function (key: string) {
                        let component = components[key];
                        let componentName: string = component.name.split(/(?=[A-Z])/).join('-').toLowerCase();
                        appearanceComponents[componentName] = new component();
                    }
                );

                loadModule([getBlockComponentPath(config)], (BlockInstance: any) => {
                    return resolve(new BlockInstance(parent, stage, config, formData, new appearanceApplier(appearanceComponents)));
                }, (error: string) => {
                    return reject(error);
                });
            });
        });
    });
}
